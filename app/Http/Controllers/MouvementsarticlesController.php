<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Mouvement;
use App\Models\Mouvementsarticle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MouvementsarticlesController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(auth()->user()->can('Voir la liste des mouvements d articles'), 403);

        $filters = [
            'type' => $request->type,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'articles_id' => $request->articles_id,
            'reference' => $request->reference,
        ];

        $data = [
            'name' => 'Gestion',
            'classe' => 'Connexion',
            'vue' => 'mouvementsarticles',
            'title' => 'Mouvements des articles',
            'articles' => Article::articles(),
            'mouvements' => Mouvement::mouvements($filters),
            'filters' => $filters,
        ];

        return view('mouvementsarticles.index', $data);
    }

    public function ajouter(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type' => ['required', Rule::in(['entree', 'sortie'])],
                'date_mouvement' => 'required|date',
                'reference' => 'nullable|string|max:255|unique:mouvements,reference',
                'observation' => 'nullable|string',
                'articles' => 'required|array|min:1',
                'articles.*.articles_id' => 'required|integer|exists:articles,id',
                'articles.*.quantite' => 'required|integer|min:1',
            ],
            [
                'type.required' => 'Le type de mouvement est obligatoire.',
                'type.in' => 'Le type de mouvement doit être entrée ou sortie.',
                'date_mouvement.required' => 'La date du mouvement est obligatoire.',
                'articles.required' => 'Ajoutez au moins un article.',
                'articles.min' => 'Ajoutez au moins un article.',
                'articles.*.articles_id.required' => 'Sélectionnez un article.',
                'articles.*.quantite.required' => 'Saisissez une quantité.',
                'articles.*.quantite.min' => 'La quantité doit être supérieure à 0.',
                'reference.unique' => 'Cette référence existe déjà.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        if ($data['type'] === 'entree') {
            abort_unless(auth()->user()->can('Ajouter une entrée d articles'), 403);
        } else {
            abort_unless(auth()->user()->can('Ajouter une sortie d articles'), 403);
        }

        $articles = $this->fusionnerArticles($data['articles']);

        DB::beginTransaction();

        try {
            if ($data['type'] === 'sortie') {
                foreach ($articles as $item) {
                    $stock = Article::stockDisponible($item['articles_id']);

                    if ($stock < $item['quantite']) {
                        $article = Article::find($item['articles_id']);
                        throw new \Exception("Stock insuffisant pour l'article " . ($article->libelle ?? $item['articles_id']) . ". Stock disponible : " . $stock);
                    }
                }
            }

            $mouvement = Mouvement::create([
                'reference' => !empty($data['reference']) ? mb_strtoupper($data['reference']) : $this->genererReference($data['type']),
                'type' => $data['type'],
                'date_mouvement' => $data['date_mouvement'],
                'observation' => !empty($data['observation']) ? ucfirst($data['observation']) : null,
                'userAdd' => Auth::id(),
            ]);

            foreach ($articles as $item) {
                Mouvementsarticle::create([
                    'mouvements_id' => $mouvement->id,
                    'articles_id' => $item['articles_id'],
                    'quantite' => $data['type'] === 'entree' ? $item['quantite'] : -$item['quantite'],
                    'userAdd' => Auth::id(),
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Mouvement enregistré avec succès'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ], 422);
        }
    }

    public function show($id)
    {
        abort_unless(auth()->user()->can('Voir le détail d un mouvement'), 403);

        $mouvement = Mouvement::where('supprimer', 0)->findOrFail($id);

        $data = [
            'name' => 'Gestion',
            'classe' => 'Connexion',
            'vue' => 'mouvementsarticles',
            'title' => 'Détail du mouvement',
            'mouvement' => $mouvement,
            'details' => Mouvement::detail($id),
        ];

        return view('mouvementsarticles.show', $data);
    }

    public function confirmersuppression(Request $request)
    {
        abort_unless(auth()->user()->can('Supprimer ou annuler un mouvement'), 403);

        if (!isset($request->id) || !is_numeric($request->id)) {
            return response()->json(['error' => "impossible d'effectuer cette annulation"], 422);
        }

        $mouvement = Mouvement::where('supprimer', 0)->find($request->id);

        if (!$mouvement) {
            return response()->json(['error' => 'Mouvement introuvable'], 404);
        }

        DB::beginTransaction();

        try {
            $details = Mouvement::detail($mouvement->id);

            if ($mouvement->type === 'entree') {
                foreach ($details as $detail) {
                    $stock = Article::stockDisponible($detail->articles_id);

                    if ($stock < abs($detail->quantite)) {
                        throw new \Exception("Impossible d'annuler cette entrée : le stock de l'article {$detail->article} a déjà été utilisé.");
                    }
                }
            }

            Mouvementsarticle::where('mouvements_id', $mouvement->id)->update([
                'supprimer' => 1,
                'userDelete' => Auth::id(),
                'deleted_at' => Carbon::now(),
            ]);

            $mouvement->update([
                'supprimer' => 1,
                'userDelete' => Auth::id(),
                'deleted_at' => Carbon::now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => "Mouvement annulé avec succès"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }

    private function fusionnerArticles($articles)
    {
        $fusion = [];

        foreach ($articles as $article) {
            $articles_id = (int) $article['articles_id'];
            $quantite = (int) $article['quantite'];

            if (!isset($fusion[$articles_id])) {
                $fusion[$articles_id] = [
                    'articles_id' => $articles_id,
                    'quantite' => 0,
                ];
            }

            $fusion[$articles_id]['quantite'] += $quantite;
        }

        return array_values($fusion);
    }

    private function genererReference($type)
    {
        $prefix = $type === 'entree' ? 'ENT-ART' : 'SOR-ART';

        return $prefix . '-' . Carbon::now()->format('YmdHis') . '-' . Auth::id();
    }
}

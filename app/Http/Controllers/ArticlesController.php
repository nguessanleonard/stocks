<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticlesController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->can('Voir la liste des articles'), 403);

        $data = [
            'name' => 'Gestion',
            'classe' => 'Connexion',
            'vue' => 'articles',
            'title' => 'Gestion des articles',
            'articles' => Article::articles(),
        ];

        return view('articles.index', $data);
    }

    public function ajouter(Request $request)
    {
        abort_unless(auth()->user()->can('Ajouter un article'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'libelle' => 'required|string',
                'code' => 'required|string|unique:articles,code',
                'unite' => 'nullable|string|max:50',
                'stock_minimum' => 'nullable|integer|min:0',
                'description' => 'nullable|string',
            ],
            [
                'libelle.required' => 'Le champ libellé est obligatoire.',
                'code.required' => 'Le champ code est obligatoire.',
                'code.unique' => 'Ce code existe déjà pour un autre article.',
                'stock_minimum.integer' => 'Le stock minimum doit être un nombre.',
                'stock_minimum.min' => 'Le stock minimum ne peut pas être négatif.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        Article::query()->create([
            'libelle' => mb_strtoupper($data['libelle']),
            'code' => mb_strtoupper($data['code']),
            'unite' => !empty($data['unite']) ? mb_strtoupper($data['unite']) : null,
            'stock_minimum' => $data['stock_minimum'] ?? 0,
            'description' => !empty($data['description']) ? ucfirst($data['description']) : null,
            'userAdd' => Auth::id(),
        ]);

        return response()->json([
            'success' => 'Article ajouté avec succès.',
        ]);
    }

    public function update(Request $request, $id)
    {
        abort_unless(auth()->user()->can('Modifier un article'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'libelle' => 'required|string',
                'code' => [
                    'required',
                    'string',
                    Rule::unique('articles', 'code')->ignore($id),
                ],
                'unite' => 'nullable|string|max:50',
                'stock_minimum' => 'nullable|integer|min:0',
                'description' => 'nullable|string',
            ],
            [
                'libelle.required' => 'Le champ libellé est obligatoire.',
                'code.required' => 'Le champ code est obligatoire.',
                'code.unique' => 'Ce code existe déjà pour un autre article.',
                'stock_minimum.integer' => 'Le stock minimum doit être un nombre.',
                'stock_minimum.min' => 'Le stock minimum ne peut pas être négatif.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'error' => 'Article introuvable'
            ], 404);
        }

        $data = $validator->validated();

        $article->update([
            'libelle' => mb_strtoupper($data['libelle']),
            'code' => mb_strtoupper($data['code']),
            'unite' => !empty($data['unite']) ? mb_strtoupper($data['unite']) : null,
            'stock_minimum' => $data['stock_minimum'] ?? 0,
            'description' => !empty($data['description']) ? ucfirst($data['description']) : null,
            'userUpdate' => Auth::id(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => "Article mis à jour avec succès"
        ]);
    }

    public function confirmersuppression(Request $request)
    {
        abort_unless(auth()->user()->can('Supprimer un article'), 403);

        if (!isset($request->id) || !is_numeric($request->id)) {
            return response()->json(['error' => "impossible d'effectuer cette suppression"], 422);
        }

        if (Article::existe($request->id)) {
            return response()->json([
                'errors' => [
                    'article' => ['Cet article est déjà utilisé dans un mouvement, suppression impossible']
                ]
            ], 422);
        }

        Article::query()->where('id', $request->id)->update([
            'supprimer' => 1,
            'userDelete' => Auth::id(),
            'deleted_at' => Carbon::now()
        ]);

        return response()->json(['success' => "Suppression effectuée avec succès"]);
    }

    public function liste()
    {
        abort_unless(auth()->user()->can('Voir la liste des articles'), 403);

        return response()->json(Article::articles());
    }
}

<?php

    namespace App\Http\Controllers;

    use App\Models\Approvisionnementsproduit;
    use App\Models\Fournisseur;
    use Carbon\Carbon;
    use App\Models\Anneesmois;
    use App\Models\Approvisionnement;
    use App\Models\Produit;
    use App\Models\Produitsprixachat;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\Rule;

    class ApprovisionnementsController extends Controller
    {
        public function index()
        {
            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'approvisionnement',
                'title' => 'Gestion des approvisionnements',
                'approvisionnements' => Approvisionnement::approvisionnements(),
            ];

            return view('approvisionnements.index', $data);
        }

        public function filtrer(Request $request)
        {

            $debut = $request->date_debut;
            $fin = $request->date_fin;

            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'approvisionnement',
                'title' => 'Gestion des approvisionnements',
                'approvisionnements' => Approvisionnement::approvisionnementsfiltrer(),
            ];


            return view('approvisionnements.index', $data);
        }
        function moisAnneeEnLettre($date = null)
        {
            Carbon::setLocale('fr');

            $date = $date ? Carbon::parse($date) : Carbon::now();

            return $date->translatedFormat('F Y');
        }

        public function ajouter(Request $request)
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'fournisseurs_id' => 'required',
                    'produits' => 'required|array|min:1',
                    'produits.*.produitsprixachats_id' => 'required|integer',
                    'produits.*.quantite' => 'required|integer|min:1',
                    'produits.*.prix' => 'required|numeric'
                ], [
                'fournisseurs_id.required' => 'Le fournisseur est obligatoire.',
                'produits.required' => 'Ajoutez au moins un produit.',
                'produits.min' => 'Ajoutez au moins un produit.',
                'produits.*.quantite.min' => 'La quantité doit être supérieure à 0.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            $m = $this->moisAnneeEnLettre();
            $resultat = explode(' ', $m);

            $mois = mb_strtoupper($resultat[0]);
            $annee = $resultat[1];

            $anneemois = Anneesmois::getannesmois_id($mois, $annee);


            if (!empty($anneemois)) {

                $anneemois_id = $anneemois->id;

            } else {
                return response()->json([
                    'success' => false,
                    'errors' => "impossible d'effectuer cette opération"
                ], 422);
            }

            $data = $validator->validated();

            $approvisionnement = [
                'fournisseurs_id' => $data['fournisseurs_id'],
                'anneesmois_id' => $anneemois_id,
                'libelle' => "APP-" . Carbon::now()->format('d-m-Y') . $data['fournisseurs_id'] . $anneemois_id,
                'userAdd' => Auth::id(),
            ];

            $appro = Approvisionnement::create($approvisionnement);


            foreach ($request->produits as $item) {

                DB::table('approvisionnementsproduits')->insert([
                    'produitsprixachats_id' => $item['produitsprixachats_id'],
                    'quantite' => $item['quantite'],
                    'nombre' => $item['quantite'],
                    'approvisionnements_id' => $appro->id,
                    'created_at' => now()
                ]);

                DB::table('produits')
                    ->where('id', $item['produits_id'])
                    ->increment('quantite', $item['quantite']);

            }
            return response()->json([
                'success' => true,
                'message' => 'Enregistrement effectué avec succès'
            ]);
        }

        public function update(Request $request, $id)
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'quantite' => 'required|integer|min:1',
                    'quantiteold' => 'required|integer|min:1',
                    'produits_id' => 'required|integer|exists:produits,id',
                    'approvisionnementsproduits_id' => 'required|integer|exists:approvisionnementsproduits,id',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            $approproduit = Approvisionnementsproduit::find($id);

            if (!$approproduit) {
                return response()->json([
                    'error' => 'Produit introuvable'
                ], 404);
            }

            // Mise à jour
            $approproduit->update([
                'quantite' => $validated['quantite'],
                'nombre' => $validated['quantite'],
                'userUpdate' => Auth::id(),
                'updated_at' => now(),
            ]);

            // 🔥 Calcul différence
            $difference = $validated['quantite'] - $validated['quantiteold'];

            if ($difference > 0) {
                Produit::where('id', $validated['produits_id'])
                    ->increment('quantite', $difference);
            } elseif ($difference < 0) {
                Produit::where('id', $validated['produits_id'])
                    ->decrement('quantite', abs($difference));
            }

            return response()->json([
                'success' => "Mise à jour effectuée avec succès"
            ]);
        }

        public function confirmersuppression(Request $request)
        {
            if (!isset($request->id) || !is_numeric($request->id)) {
                return response()->json([
                    'error' => "impossible d'effectuer cette suppression"
                ], 400);
            }

            $verif = Approvisionnementsproduit::find($request->id);

            if (!$verif) {
                return response()->json([
                    'error' => "approvisionnement introuvable"
                ], 404);
            }

            // ❌ suppression interdite si stock déjà utilisé
            if ($verif->nombre != $verif->quantite) {
                return response()->json([
                    'error' => "Impossible de supprimer : ce stock a déjà été utilisé"
                ], 422);
            }

            DB::beginTransaction();

            try {

                // 🧮 retour stock produit
                DB::table('produits')
                    ->where('id', $request->produits_id)
                    ->decrement('quantite', $request->quantite);

                // 🗑 soft delete
                $verif->update([
                    'supprimer' => 1,
                    'userDelete' => Auth::id(),
                    'deleted_at' => Carbon::now()
                ]);

                DB::commit();

                return response()->json([
                    'success' => "Suppression effectuée avec succès"
                ]);

            } catch (\Exception $e) {

                DB::rollBack();

                return response()->json([
                    'error' => "Erreur serveur : " . $e->getMessage()
                ], 500);
            }
        }

    }

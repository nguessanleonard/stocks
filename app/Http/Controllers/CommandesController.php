<?php

    namespace App\Http\Controllers;

    use App\Models\Anneesmois;
    use App\Models\Approvisionnement;
    use App\Models\Approvisionnementsproduit;
    use App\Models\Client;
    use App\Models\Commande;
    use App\Models\Commandesproduit;
    use App\Models\Produit;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Validator;

    class CommandesController extends Controller
    {
        public function index()
        {
            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'approvisionnement',
                'title' => 'Gestion des commandes',
                'commandes' => Commande::commandes(),
            ];

            return view('commandes.index', $data);
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
                    'clients_id' => 'nullable|integer',
                    'produits' => 'required|array|min:1',
                    'produits.*.produitsprixventes_id' => 'required|integer',
                    'produits.*.quantite' => 'required|integer|min:1',
                    'produits.*.prix' => 'required|numeric'
                ], [
                'clients_id.integer' => 'Le client est obligatoire.',
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
            $clients_id = $data['clients_id']
                ?? Client::getclientinconnu('indefini.indefini@gmail.com');
            $commande = [
                'clients_id' => $clients_id,
                'anneesmois_id' => $anneemois_id,
                'libelle' => "APP-" . Carbon::now()->format('d-m-Y') . $clients_id . $anneemois_id,
                'userAdd' => Auth::id(),
            ];

            $cmd = Commande::create($commande);


            foreach ($request->produits as $item) {

                DB::table('commandesproduits')->insert([
                    'produitsprixventes_id' => $item['produitsprixventes_id'],
                    'quantite' => $item['quantite'],
                    'commandes_id' => $cmd->id,
                    'created_at' => now()
                ]);

                DB::table('produits')
                    ->where('id', $item['produits_id'])
                    ->decrement('quantite', $item['quantite']);

            }
            return response()->json([
                'success' => true,
                'message' => 'Enregistrement effectué de la commande efféctué avec succès'
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
                    'commandesproduits_id' => 'required|integer|exists:commandesproduits,id',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            $commproduit = Commandesproduit::find($id);

            if (!$commproduit) {
                return response()->json([
                    'error' => 'Produit introuvable'
                ], 404);
            }

            // Mise à jour
            $commproduit->update([
                'quantite' => $validated['quantite'],
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

            if (isset($request->id) && is_numeric($request->id) && !is_null($request->id)) {

                $verif = Commandesproduit::find($request->id);

                if (!$verif) {
                    return response()->json([
                        'errors' => [
                            'produit' => ['suppression impossible']
                        ]
                    ], 422);
                } else {
                    $data = [
                        'supprimer' => 1,
                        'userDelete' => Auth::id(),
                        'deleted_at' => Carbon::now()
                    ];

                    DB::table('produits')
                        ->where('id', $request->produits_id)
                        ->decrement('quantite', $request->quantite);

                    Commandesproduit::query()->where('id', '=', $request->id)->update($data);


                    return response()->json(['success' => "la suppression a été effectuée avec succès"]);
                }

            } else {

                return response()->json(['error' => "impossible d'effectuer cette suppression"]);
            }

        }
    }

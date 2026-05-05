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

        public function filtrer(Request $request)
        {

            $debut = $request->date_debut;
            $fin = $request->date_fin;

            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'approvisionnement',
                'title' => 'Gestion des commandes',
                'commandes' => Commande::commandesFilter($debut, $fin),
            ];


            return view('commandes.index', $data);
        }

        function moisAnneeEnLettre($date = null)
        {
            Carbon::setLocale('fr');

            $date = $date ? Carbon::parse($date) : Carbon::now();

            return $date->translatedFormat('F Y');
        }

        public function ajouter1(Request $request)
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

        public function ajouter(Request $request)
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'clients_id' => 'nullable|integer',
                    'produits' => 'required|array|min:1',
                    'produits.*.produitsprixventes_id' => 'required|integer',
                    'produits.*.produits_id' => 'required|integer',
                    'produits.*.quantite' => 'required|integer|min:1',
                    'produits.*.prix' => 'required|numeric'
                ],
                [
                    'produits.required' => 'Ajoutez au moins un produit.',
                    'produits.min' => 'Ajoutez au moins un produit.',
                    'produits.*.quantite.min' => 'La quantité doit être supérieure à 0.'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // 📅 Mois / Année
            $m = $this->moisAnneeEnLettre();
            $resultat = explode(' ', $m);

            $mois = mb_strtoupper($resultat[0]);
            $annee = $resultat[1];

            $anneemois = Anneesmois::getannesmois_id($mois, $annee);

            if (!$anneemois) {
                return response()->json([
                    'success' => false,
                    'errors' => "Impossible d'effectuer cette opération"
                ], 422);
            }

            $data = $validator->validated();

            $clients_id = $data['clients_id']
                ?? Client::getclientinconnu('indefini.indefini@gmail.com');

            DB::beginTransaction();

            try {

                // 🧾 Création commande
                $cmd = Commande::create([
                    'clients_id' => $clients_id,
                    'anneesmois_id' => $anneemois->id,
                    'libelle' => "CMD-" . now()->format('d-m-Y') . $clients_id . $anneemois->id,
                    'userAdd' => Auth::id(),
                ]);

                foreach ($request->produits as $item) {

                    $produitId = intval($item['produits_id']);
                    $quantite = $item['quantite'];

                    // 🔒 1. Vérification stock total
                    $totalStock = DB::table('approvisionnementsproduits as appr')
                        ->join('produitsprixachats as ppa', 'appr.produitsprixachats_id', '=', 'ppa.id')
                        ->where('ppa.produits_id', $produitId)

                        ->sum('appr.nombre');

                    $totalStock = $totalStock ?? 0;
                    $produit=Produit::query()->where('id',$produitId)->first();
                    if ($totalStock < $quantite) {
                        throw new \Exception("Stock insuffisant pour le produit ID $produit->libelle");
                    }

                    // 📝 2. Enregistrement ligne commande
                    DB::table('commandesproduits')->insert([
                        'produitsprixventes_id' => $item['produitsprixventes_id'],
                        'quantite' => $quantite,
                        'commandes_id' => $cmd->id,
                        'created_at' => now()
                    ]);

                    // 📉 3. Décrément stock global produit
                    DB::table('produits')
                        ->where('id', $produitId)
                        ->decrement('quantite', $quantite);

                    // 🔁 4. FIFO approvisionnement
                    $quantiteRestante = $quantite;

                    $approvisionnements = DB::table('approvisionnementsproduits as appr')
                        ->join('produitsprixachats as ppa', 'appr.produitsprixachats_id', '=', 'ppa.id')
                        ->where('ppa.produits_id', $produitId)
                        ->where('appr.nombre', '>', 0)
                        ->orderBy('appr.created_at', 'asc')
                        ->select('appr.id', 'appr.nombre')
                        ->get();

                    foreach ($approvisionnements as $appro) {

                        if ($quantiteRestante <= 0) break;

                        if ($appro->nombre >= $quantiteRestante) {

                            DB::table('approvisionnementsproduits')
                                ->where('id', $appro->id)
                                ->decrement('nombre', $quantiteRestante);

                            $quantiteRestante = 0;

                        } else {

                            DB::table('approvisionnementsproduits')
                                ->where('id', $appro->id)
                                ->update(['nombre' => 0]);

                            $quantiteRestante -= $appro->nombre;
                        }
                    }

                    // ❌ Sécurité finale FIFO
                    if ($quantiteRestante > 0) {
                        throw new \Exception("Erreur FIFO sur produit ID $produit->libelle");
                    }
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Commande enregistrée avec succès'
                ]);

            } catch (\Exception $e) {

                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'errors' => $e->getMessage()
                ], 422);
            }
        }


        public function update(Request $request, $id)
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'quantite' => 'required|integer|min:1',
                    'quantiteold' => 'required|integer|min:1',
                    'produits_id' => 'required|integer|exists:produits,id',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            $commproduit = Commandesproduit::find($id);

            if (!$commproduit) {
                return response()->json([
                    'error' => 'Produit introuvable'
                ], 404);
            }

            DB::beginTransaction();

            try {

                $produitId = $data['produits_id'];

                $oldQty = $data['quantiteold'];
                $newQty = $data['quantite'];
                $difference = $newQty - $oldQty;

                /*
                ---------------------------------------------------
                1. ANNULATION DE L'ANCIEN IMPACT FIFO
                ---------------------------------------------------
                */

                if ($oldQty > 0) {

                    $restant = $oldQty;

                    $appros = DB::table('approvisionnementsproduits as appr')
                        ->join('produitsprixachats as ppa', 'appr.produitsprixachats_id', '=', 'ppa.id')
                        ->where('ppa.produits_id', $produitId)
                        ->orderBy('appr.created_at', 'desc') // 🔥 INVERSE FIFO pour restituer
                        ->select('appr.id', 'appr.nombre')
                        ->get();

                    foreach ($appros as $app) {

                        if ($restant <= 0) break;

                        DB::table('approvisionnementsproduits')
                            ->where('id', $app->id)
                            ->increment('nombre', min($restant, $oldQty));

                        $restant -= $app->nombre;
                    }

                    // stock global retour
                    DB::table('produits')
                        ->where('id', $produitId)
                        ->increment('quantite', $oldQty);
                }

                /*
                ---------------------------------------------------
                2. APPLICATION NOUVELLE QUANTITE
                ---------------------------------------------------
                */

                if ($newQty > 0) {

                    // vérifier stock total
                    $totalStock = DB::table('approvisionnementsproduits as appr')
                        ->join('produitsprixachats as ppa', 'appr.produitsprixachats_id', '=', 'ppa.id')
                        ->where('ppa.produits_id', $produitId)
                        ->where('ppa.supprimer', 0)
                        ->sum('appr.nombre');

                    if ($totalStock < $newQty) {
                        throw new \Exception("Stock insuffisant pour modification");
                    }

                    $restant = $newQty;

                    $approvisionnements = DB::table('approvisionnementsproduits as appr')
                        ->join('produitsprixachats as ppa', 'appr.produitsprixachats_id', '=', 'ppa.id')
                        ->where('ppa.produits_id', $produitId)
                        ->where('appr.nombre', '>', 0)
                        ->orderBy('appr.created_at', 'asc')
                        ->select('appr.id', 'appr.nombre')
                        ->get();

                    foreach ($approvisionnements as $appro) {

                        if ($restant <= 0) break;

                        if ($appro->nombre >= $restant) {

                            DB::table('approvisionnementsproduits')
                                ->where('id', $appro->id)
                                ->decrement('nombre', $restant);

                            $restant = 0;

                        } else {

                            DB::table('approvisionnementsproduits')
                                ->where('id', $appro->id)
                                ->update(['nombre' => 0]);

                            $restant -= $appro->nombre;
                        }
                    }

                    if ($restant > 0) {
                        throw new \Exception("Erreur FIFO lors de la modification");
                    }

                    // stock global sortie
                    DB::table('produits')
                        ->where('id', $produitId)
                        ->decrement('quantite', $newQty);
                }

                /*
                ---------------------------------------------------
                3. UPDATE COMMANDE
                ---------------------------------------------------
                */

                $commproduit->update([
                    'quantite' => $newQty,
                    'userUpdate' => Auth::id(),
                    'updated_at' => now(),
                ]);

                DB::commit();

                return response()->json([
                    'success' => "Mise à jour effectuée avec succès"
                ]);

            } catch (\Exception $e) {

                DB::rollBack();

                return response()->json([
                    'error' => $e->getMessage()
                ], 422);
            }
        }


        public function confirmersuppression(Request $request)
        {

            if (!isset($request->id) || !is_numeric($request->id)) {
                return response()->json([
                    'error' => "impossible d'effectuer cette suppression"
                ]);
            }

            $ligne = Commandesproduit::find($request->id);

            if (!$ligne) {
                return response()->json([
                    'errors' => [
                        'produit' => ['suppression impossible']
                    ]
                ], 422);
            }

            DB::beginTransaction();

            try {

                $produitId = $request->produits_id;
                $quantite = intval($request->quantite);

                /*
                ---------------------------------------------------
                1. RESTAURATION FIFO (inverse)
                ---------------------------------------------------
                */

                $restant = $quantite;

                $approvisionnements = DB::table('approvisionnementsproduits as appr')
                    ->join('produitsprixachats as ppa', 'appr.produitsprixachats_id', '=', 'ppa.id')
                    ->where('ppa.produits_id', $produitId)
                    ->orderBy('appr.created_at', 'desc') // 🔥 inverse FIFO
                    ->select('appr.id', 'appr.nombre')
                    ->get();

                foreach ($approvisionnements as $appro) {

                    if ($restant <= 0) break;

                    DB::table('approvisionnementsproduits')
                        ->where('id', $appro->id)
                        ->increment('nombre', $restant);

                    $restant -= $appro->nombre;
                }

                /*
                ---------------------------------------------------
                2. RESTAURATION STOCK PRODUIT GLOBAL
                ---------------------------------------------------
                */

                DB::table('produits')
                    ->where('id', $produitId)
                    ->increment('quantite', $quantite);

                /*
                ---------------------------------------------------
                3. MARQUER SUPPRESSION
                ---------------------------------------------------
                */

                $ligne->update([
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
                    'error' => $e->getMessage()
                ], 422);
            }
        }
    }

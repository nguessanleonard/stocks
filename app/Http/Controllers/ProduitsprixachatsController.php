<?php

    namespace App\Http\Controllers;

    use App\Models\Fournisseur;
    use App\Models\Prixachat;
    use App\Models\Produit;
    use App\Models\Produitsprixachat;
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;

    class ProduitsprixachatsController extends Controller
    {
        public function index()
        {

            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'Login page',
                'title' => "Gestion des prix d'achat des Produits",
                'produits' => Produit::produits(),
                'produitsprixachats' => Produitsprixachat::produitsprixachats(),
            ];

            return view('produitsprixachats.index', $data);
        }

        public function ajouter1(Request $request)
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'produits_id' => 'required|integer|exists:produits,id',
                    'prixachat' => 'required|numeric|min:0',
                ],
                [
                    'produits_id.required' => 'Le produit est obligatoire.',
                    'produits_id.exists' => 'Le produit sélectionné est invalide.',

                    'prixachat.required' => 'Le prix d\'achat est obligatoire.',
                    'prixachat.numeric' => 'Le prix d\'achat doit être un nombre.',
                    'prixachat.min' => 'Le prix d\'achat doit être supérieur ou égal à 0.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            $prixachats = Prixachat::getprixachats($data['prixachat']);

            if (!empty($prixachats_id)) {

                $prixachats_id = $prixachats->id;
            } else {

                $prixachats = Prixachat::query()->create(['montant' => $data['prixachat'], 'userAdd' => Auth::id()]);
            }

            $prixachatproduit = Produitsprixachat::existeproduitprixachat($data['produits_id']);

            if (!empty($prixachatproduit) && $prixachatproduit->montant != $data['prixachat']) {

                Produitsprixachat::query()->where('id', $prixachatproduit->id)->update(['statut' => 0, 'userUpdate' => Auth::id()]);

                $dataProduitsprixachat = [
                    'produits_id' => $data['produits_id'],

                    'prixachats_id' => $prixachats->id,

                    'userAdd' => Auth::id(),
                ];

                Produitsprixachat::query()->create($dataProduitsprixachat);
            }


            return response()->json([
                'success' => "Le prix d'achat de ce produit a été ajouté avec succès.",
            ]);
        }

        public function ajouter(Request $request)
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'produits_id' => 'required|integer|exists:produits,id',
                    'prixachat'   => 'required|numeric|min:0',
                ],
                [
                    'produits_id.required' => 'Le produit est obligatoire.',
                    'produits_id.exists'   => 'Le produit sélectionné est invalide.',

                    'prixachat.required' => 'Le prix d\'achat est obligatoire.',
                    'prixachat.numeric'  => 'Le prix d\'achat doit être un nombre.',
                    'prixachat.min'      => 'Le prix d\'achat doit être supérieur ou égal à 0.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            // 🔍 Vérifier si le prix existe déjà
            $prixachats = Prixachat::getprixachats($data['prixachat']);

            if ($prixachats) {
                $prixachats_id = $prixachats->id;
            } else {
                $newPrix = Prixachat::create([
                    'montant' => $data['prixachat'],
                    'userAdd' => Auth::id()
                ]);
                $prixachats_id = $newPrix->id;
            }

            // 🔍 Vérifier si le produit a déjà un prix actif
            $prixachatproduit = Produitsprixachat::existeproduitprixachat($data['produits_id']);

            if ($prixachatproduit) {

                // Si le prix est différent → on désactive l'ancien
                if ($prixachatproduit->prixachats_id != $prixachats_id) {

                    Produitsprixachat::where('id', $prixachatproduit->id)
                        ->update([
                            'statut' => 0,
                            'userUpdate' => Auth::id()
                        ]);

                    Produitsprixachat::create([
                        'produits_id'    => $data['produits_id'],
                        'prixachats_id'  => $prixachats_id,
                        'userAdd'        => Auth::id(),
                    ]);
                }

            } else {
                // Aucun prix encore → on crée directement
                Produitsprixachat::create([
                    'produits_id'    => $data['produits_id'],
                    'prixachats_id'  => $prixachats_id,
                    'userAdd'        => Auth::id(),
                ]);
            }

            return response()->json([
                'success' => "Le prix d'achat de ce produit a été ajouté avec succès.",
            ]);
        }
    }

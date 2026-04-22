<?php

    namespace App\Http\Controllers;

    use App\Models\Prixachat;
    use App\Models\Prixvente;
    use App\Models\Produit;
    use App\Models\Produitsprixachat;
    use App\Models\Produitsprixvente;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;

    class ProduitsprixventesController extends Controller
    {
        public function index()
        {

            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'Login page',
                'title' => "Gestion des prix de vente des Produits",
                'produits' => Produit::produits(),
                'produitsprixaventes' => Produitsprixvente::produitsprixventes(),
            ];

            return view('produitsprixventes.index', $data);
        }


        public function ajouter(Request $request)
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'produits_id' => 'required|integer|exists:produits,id',
                    'prixvente' => 'required|numeric|min:0',
                ],
                [
                    'produits_id.required' => 'Le produit est obligatoire.',
                    'produits_id.exists' => 'Le produit sélectionné est invalide.',

                    'prixvente.required' => 'Le prix d\'achat est obligatoire.',
                    'prixvente.numeric' => 'Le prix d\'achat doit être un nombre.',
                    'prixvente.min' => 'Le prix d\'achat doit être supérieur ou égal à 0.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            // 🔍 Vérifier si le prix existe déjà
            $prixventes = Prixvente::getprixachats($data['prixvente']);

            if ($prixventes) {
                $prixventes_id = $prixventes->id;
            } else {
                $newPrix = Prixvente::create([
                    'montant' => $data['prixvente'],
                    'userAdd' => Auth::id()
                ]);
                $prixventes_id = $newPrix->id;
            }

            // 🔍 Vérifier si le produit a déjà un prix actif
            $prixventeproduit = Produitsprixvente::existeproduitprixvente($data['produits_id']);

            if ($prixventeproduit) {

                // Si le prix est différent → on désactive l'ancien
                if ($prixventeproduit->prixventes_id != $prixventes_id) {

                    Produitsprixvente::where('id', $prixventeproduit->id)
                        ->update([
                            'statut' => 0,
                            'userUpdate' => Auth::id()
                        ]);

                    Produitsprixvente::create([
                        'produits_id' => $data['produits_id'],
                        'prixventes_id' => $prixventes_id,
                        'userAdd' => Auth::id(),
                    ]);
                }

            } else {
                // Aucun prix encore → on crée directement
                Produitsprixvente::create([
                    'produits_id' => $data['produits_id'],
                    'prixventes_id' => $prixventes_id,
                    'userAdd' => Auth::id(),
                ]);
            }

            return response()->json([
                'success' => "Le prix d'achat de ce produit a été ajouté avec succès.",
            ]);
        }
    }

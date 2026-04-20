<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Prixachat;
use App\Models\Produit;
use App\Models\Produitsprixachat;
use Illuminate\Http\Request;

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
}

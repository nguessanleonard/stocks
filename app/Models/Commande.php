<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Commande extends Model
{
    protected $table = "commandes";

    protected $fillable = [

        'libelle',
        'anneesmois_id',
        'clients_id',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];
    public static function commandes()
    {
        return  DB::table('commandes as c')
            ->join('clients as cl', 'c.clients_id', '=', 'cl.id')
            ->join('anneesmois as am', 'c.anneesmois_id', '=', 'am.id')
            ->join('annees as a', 'am.annees_id', '=', 'a.id')
            ->join('mois as m', 'am.mois_id', '=', 'm.id')
            ->join('commandesproduits as cp', 'cp.commandes_id', '=', 'c.id')
            ->join('produitsprixventes as ppv', 'cp.produitsprixventes_id', '=', 'ppv.id')
            ->join('produits as p', 'ppv.produits_id', '=', 'p.id')
            ->join('prixventes as pv', 'ppv.prixventes_id', '=', 'pv.id')
            ->where('c.supprimer', 0)
            ->where('cp.supprimer', 0)
            ->select(
                'p.libelle as produit',
                'p.code',
                'p.photo',
                'p.id as produits_id',
                'cp.id as commandesproduits_id',
                'pv.montant',
                'cp.produitsprixventes_id',
                'cl.noms as client',
                'cl.id as clients_id',
                'cp.quantite as quantiteproduitcommande',
                'c.libelle as commande',
                'm.libelle as mois',
                'a.libelle as annee'
            )
            ->orderBy('c.created_at', 'desc')
            ->get();
    }
}

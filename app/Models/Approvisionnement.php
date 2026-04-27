<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Approvisionnement extends Model
{
    protected $table = "approvisionnements";

    protected $fillable = [

        'libelle',
        'anneesmois_id',
        'fournisseurs_id',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];
    public static function approvisionnements()
    {
        return  DB::table('approvisionnements as appr')
            ->join('fournisseurs as f', 'appr.fournisseurs_id', '=', 'f.id')
            ->join('anneesmois as am', 'appr.anneesmois_id', '=', 'am.id')
            ->join('annees as a', 'am.annees_id', '=', 'a.id')
            ->join('mois as m', 'am.mois_id', '=', 'm.id')
            ->join('approvisionnementsproduits as apprp', 'apprp.approvisionnements_id', '=', 'appr.id')
            ->join('produitsprixachats as ppa', 'apprp.produitsprixachats_id', '=', 'ppa.id')
            ->join('produits as p', 'ppa.produits_id', '=', 'p.id')
            ->join('prixachats as pa', 'ppa.prixachats_id', '=', 'pa.id')
            ->where('appr.supprimer', 0)
            ->where('apprp.supprimer', 0)
            ->select(
                'p.libelle as produit',
                'p.code',
                'p.photo',
                'p.id as produits_id',
                'apprp.id as approvisionnementsproduits_id',
                'pa.montant',
                'apprp.produitsprixachats_id',
                'f.libelle as fournisseur',
                'f.id as fournisseurs_id',
                'apprp.quantite as quantiteproduitappro',
                'apprp.nombre',
                'appr.libelle as approvisionnement',
                'm.libelle as mois',
                'a.libelle as annee'
            )
            ->orderBy('appr.created_at', 'desc')
            ->get();
    }
}

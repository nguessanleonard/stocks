<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produitsprixvente extends Model
{
    protected $table = "produitsprixventes";

    protected $fillable = [

        'produits_id',
        'prixventes_id',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];

    public static function produitsprixventes()
    {
        return DB::table('produitsprixventes as ppv')
            ->join('prixventes as pv', 'ppv.prixventes_id', '=', 'pv.id')
            ->join('produits as p', 'ppv.produits_id', '=', 'p.id')
            ->where('ppv.statut', 1)
            ->orderBy('p.libelle')
            ->select([
                'p.libelle as produit',
                'p.code',
                'p.photo',
                'pv.montant',
                'pv.id as prixachats_id',
                'ppv.id as produitsprixventes_id'
            ])
            ->get();
    }

    public static function existeproduitprixvente($produits_id)
    {
        return DB::table('produitsprixventes as ppv')
            ->where('ppv.produits_id', $produits_id)
            ->where('ppv.statut', 1)
            ->first();
    }
}

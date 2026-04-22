<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Produitsprixachat extends Model
    {
        protected $table = "produitsprixachats";

        protected $fillable = [

            'produits_id',
            'prixachats_id',
            'userAdd',
            'userUpdate',
            'userDelete',
            'created_at',
            'updated_at',
            'deleted_at',
            'supprimer'
        ];

        public static function produitsprixachats()
        {
            return DB::table('produitsprixachats as ppa')
                ->join('prixachats as pa', 'ppa.prixachats_id', '=', 'pa.id')
                ->join('produits as p', 'ppa.produits_id', '=', 'p.id')
                ->where('ppa.statut', 1)
                ->orderBy('p.libelle')
                ->select([
                    'p.libelle as produit',
                    'p.code',
                    'p.photo',
                    'pa.montant',
                    'pa.id as prixachats_id',
                    'ppa.id as produitsprixachats_id'
                ])
                ->get();
        }

        public static function existeproduitprixachat($produits_id)
        {
            return DB::table('produitsprixachats as ppa')
                ->where('ppa.produits_id', $produits_id)
                ->where('ppa.statut', 1)
                ->first();
        }
    }

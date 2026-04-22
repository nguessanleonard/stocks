<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Produit extends Model
    {
        protected $table = "produits";

        protected $fillable = [

            'libelle',
            'code',
            'description',
            'photo',
            'qrcode',
            'quantite',
            'userAdd',
            'userUpdate',
            'userDelete',
            'created_at',
            'updated_at',
            'deleted_at',
            'supprimer'
        ];

        public static function produits()
        {

            return DB::table('produits as p')
                ->where('p.supprimer', 0)
                ->orderBy('p.libelle')
                ->get();
        }

        public static function infosproduit($code)
        {

            return DB::table('produits as p')
                ->join('produitsprixachats as ppa', 'ppa.produits_id', 'p.id')
                ->join('prixachats as pa', 'ppa.prixachats_id', '=', 'pa.id')
                ->where('p.supprimer', 0)
                ->where('p.code', $code)
                ->where('ppa.statut', 1)
                ->select([
                    'p.id',
                    'p.libelle',
                    'p.code',
                    'p.photo',
                    'pa.montant',
                    'pa.id as prixachats_id',
                    'ppa.id as produitsprixachats_id'
                ])
                ->first();
        }
        public static function infosproduitvente($code)
        {

            return DB::table('produits as p')
                ->join('produitsprixventes as ppv', 'ppv.produits_id', 'p.id')
                ->join('prixventes as pv', 'ppv.prixventes_id', '=', 'pv.id')
                ->where('p.supprimer', 0)
                ->where('p.code', $code)
                ->where('ppv.statut', 1)
                ->select([
                    'p.id',
                    'p.libelle',
                    'p.code',
                    'p.photo',
                    'pv.montant',
                    'pv.id as prixventes_id',
                    'ppv.id as produitsprixventes_id'
                ])
                ->first();
        }

        public static function existe($produits_id)
        {

            return DB::table('produits as p')
                ->join('produitsprixachats as ppa', 'ppa.produits_id', 'p.id')
                ->join('approvisionnementsproduits as ap', 'ap.produitsprixachats_id', 'ppa.id')
                ->where('p.supprimer', 0)
                ->where('p.id', $produits_id)
                ->exists();
        }
        public static function getproduits_id2($produitsprixachats_id)
        {
            return DB::table('produits as p')
                ->join('produitsprixachats as ppa', 'ppa.produits_id', 'p.id')
                ->where('p.supprimer', 0)
                ->where('ppa.statut', 1)
                ->where('ppa.id', $produitsprixachats_id)
                ->select('p.*')
                ->first();
        }
        public static function getproduits_id($produitsprixachats_id)
        {
            return DB::table('produitsprixachats as ppa')
                ->join('produits as p', 'p.id', '=', 'ppa.produits_id')
                ->where('ppa.id', $produitsprixachats_id)
                ->select('p.id', 'p.quantite')
                ->first();
        }
    }

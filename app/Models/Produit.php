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
                ->where('p.supprimer', 0)
                ->where('p.code', $code)
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
    }

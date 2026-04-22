<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Prixvente extends Model
    {
        protected $table = "prixventes";

        protected $fillable = [

            'montant',
            'userAdd',
            'userUpdate',
            'userDelete',
            'created_at',
            'updated_at',
            'deleted_at',
            'supprimer'
        ];

        public static function prixventes()
        {
            return DB::table('prixventes as pv')
                ->orderBy('pv.montant')
                ->get();
        }

        public static function getprixachats($montant)
        {
            return DB::table('prixventes as pv')
                ->where('pv.montant',$montant)
                ->first();
        }
    }

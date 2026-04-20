<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Prixachat extends Model
    {
        protected $table = "prixachats";

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

        public static function prixachats()
        {
            return DB::table('prixachats as pa')
                ->orderBy('pa.montant')
                ->get();
        }
    }

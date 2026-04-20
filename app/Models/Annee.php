<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Annee extends Model
    {
        protected $table = "annees";

        protected $fillable = ['libelle', 'created_at',
            'userAdd',
            'updated_at',
            'deleted_at',];

        public static function getannees()
        {
            return DB::table('annees as a')
                ->select('a.*')
                ->orderBy('a.libelle', 'desc')
                ->limit(3)
                ->get();
        }

    }

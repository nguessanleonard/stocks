<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;

    class Anneesmois extends Model
    {
        protected $table = "anneesmois";

        protected $fillable = ['annees_id',
            'mois_id',
            'created_at',
            'userAdd',
            'updated_at',
            'deleted_at',];


        public static function getannesmois($annees_id)
        {

            return DB::table('anneesmois  as am')
                ->join('mois as m', 'am.mois_id', '=', 'm.id')
                ->join('annees as a', 'am.annees_id', '=', 'a.id')
                ->where('am.annees_id', $annees_id)
                ->orderBy('m.id')
                ->select('m.libelle', 'am.id')
                ->get();
        }

        public static function getannesmois_id($libelemois, $libelleanne)
        {

            return DB::table('anneesmois  as am')
                ->join('mois as m', 'am.mois_id', '=', 'm.id')
                ->join('annees as a', 'am.annees_id', '=', 'a.id')
                ->where('m.libelle', $libelemois)
                ->where('a.libelle', $libelleanne)
                ->select('am.*')
                ->first();
        }

        public static function moisannes($anneesmois_id)
        {

            return DB::table('anneesmois  as am')
                ->join('mois as m', 'am.mois_id', '=', 'm.id')
                ->join('annees as a', 'am.annees_id', '=', 'a.id')
                ->where('am.id', $anneesmois_id)
                ->select('am.*', 'm.libelle as mois', 'a.libelle as annee')
                ->first();
        }

        public static function annesmois()
        {

            $now = Carbon::now();

            return DB::table('anneesmois as am')
                ->join('mois as m', 'am.mois_id', '=', 'm.id')
                ->join('annees as a', 'am.annees_id', '=', 'a.id')
                ->where('a.libelle', '<=', $now->year)
                ->select('m.libelle as mois', 'a.libelle as annee', 'am.id')
                ->get();
        }


    }

<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Mois extends Model
    {
        protected $table = "mois";

        protected $fillable = ['libelle', 'created_at',
            'userAdd',
            'updated_at',
            'deleted_at',];

        public  static function getmois(){

            return DB::table('mois as m')
                ->orderBy('m.id')
                ->get();
        }
    }

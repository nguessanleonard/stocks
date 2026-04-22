<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Client extends Model
    {
        protected $table = "clients";

        protected $fillable = [

            'noms',
            'telephone',
            'email',
            'userAdd',
            'userUpdate',
            'userDelete',
            'created_at',
            'updated_at',
            'deleted_at',
            'supprimer'
        ];

        public static function clients()
        {
            return DB::table('clients as cl')
                ->where('cl.supprimer', 0)
                ->orderBy('cl.noms')
                ->get();
        }

        public static function existe($clients_id)
        {

            return DB::table('clients as cl')
                ->join('commandes as c', 'c.clients_id', 'cl.id')
                ->where('cl.supprimer', 0)
                ->where('cl.id', $clients_id)
                ->exists();
        }
    }

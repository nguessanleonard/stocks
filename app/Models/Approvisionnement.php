<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Approvisionnement extends Model
{
    protected $table = "approvisionnements";

    protected $fillable = [

        'libelle',
        'anneesmois_id',
        'fournisseurs_id',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];
    public static function approvisionnements()
    {
        return DB::table('approvisionnements as appr')
            ->where('appr.supprimer',0)
            ->orderBy('appr.libelle')
            ->get();
    }
}

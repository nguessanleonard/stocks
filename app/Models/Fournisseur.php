<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fournisseur extends Model
{
    protected $table ="fournisseurs";

    protected $fillable = [

        'libelle',
        'telephone',
        'email',
        'logo',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];
    public static function fournisseurs()
    {
        return DB::table('fournisseurs as f')
            ->where('f.supprimer',0)
            ->orderBy('f.libelle')
            ->get();
    }

    public static function existe($produits_id)
    {

        return DB::table('fournisseurs as f')
            ->join('approvisionnements  as ap','ap.fournisseurs_id','f.id')
            ->where('f.supprimer',0)
            ->where('f.id',$produits_id)
            ->exists();
    }
}

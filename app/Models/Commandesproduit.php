<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commandesproduit extends Model
{
    protected $table = "commandesproduits";

    protected $fillable = [

        'commandes_id',
        'produitsprixventes_id',
        'quantite',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];
}

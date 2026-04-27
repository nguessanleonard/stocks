<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approvisionnementsproduit extends Model
{
    protected $table = "approvisionnementsproduits";

    protected $fillable = [

        'approvisionnements_id',
        'produitsprixachats_id',
        'quantite',
        'nombre',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];
}

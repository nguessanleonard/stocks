<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mouvementsarticle extends Model
{
    protected $table = "mouvementsarticles";

    protected $fillable = [
        'mouvements_id',
        'articles_id',
        'quantite',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];

    public function article()
    {
        return DB::table('articles  as ar')
            ->select('ar.*')
            ->get();

    }

    public function mouvement()
    {
        return DB::table('mouvements  as mvs')
            ->select('mvs.*')
            ->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(Article::class, 'articles_id');
    }

    public function mouvement()
    {
        return $this->belongsTo(Mouvement::class, 'mouvements_id');
    }
}

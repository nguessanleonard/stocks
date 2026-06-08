<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = "articles";

    protected $fillable = [
        'libelle',
        'code',
        'unite',
        'stock_minimum',
        'description',
        'userAdd',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer'
    ];

    public function mouvementsarticles()
    {
        return $this->hasMany(Mouvementsarticle::class, 'articles_id');
    }

    public static function articles()
    {
        return DB::table('articles as a')
            ->leftJoin('mouvementsarticles as ma', function ($join) {
                $join->on('ma.articles_id', '=', 'a.id')
                    ->where('ma.supprimer', 0);
            })
            ->leftJoin('mouvements as m', function ($join) {
                $join->on('m.id', '=', 'ma.mouvements_id')
                    ->where('m.supprimer', 0);
            })
            ->where('a.supprimer', 0)
            ->select(
                'a.*',
                DB::raw('COALESCE(SUM(CASE WHEN m.id IS NULL THEN 0 ELSE ma.quantite END), 0) as stock')
            )
            ->groupBy('a.id', 'a.libelle', 'a.code', 'a.unite', 'a.stock_minimum', 'a.description', 'a.userAdd', 'a.userUpdate', 'a.userDelete', 'a.supprimer', 'a.created_at', 'a.updated_at', 'a.deleted_at')
            ->orderBy('a.libelle')
            ->get();
    }

    public static function stockDisponible($articles_id)
    {
        return (int) DB::table('mouvementsarticles as ma')
            ->join('mouvements as m', 'm.id', '=', 'ma.mouvements_id')
            ->where('ma.articles_id', $articles_id)
            ->where('ma.supprimer', 0)
            ->where('m.supprimer', 0)
            ->sum('ma.quantite');
    }

    public static function existe($articles_id)
    {
        return DB::table('mouvementsarticles as ma')
            ->join('mouvements as m', 'm.id', '=', 'ma.mouvements_id')
            ->where('ma.articles_id', $articles_id)
            ->where('ma.supprimer', 0)
            ->where('m.supprimer', 0)
            ->exists();
    }
}

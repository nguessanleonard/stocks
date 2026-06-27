<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mouvement extends Model
{
    protected $table = "mouvements";

    protected $fillable = [
        'reference',
        'type',
        'date_mouvement',
        'observation',
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
        return $this->hasMany(Mouvementsarticle::class, 'mouvements_id');
    }

    public static function mouvements($filters = [], $perPage = 50)
    {
        return DB::table('mouvements as m')
            ->join('mouvementsarticles as ma', 'ma.mouvements_id', '=', 'm.id')
            ->join('articles as a', 'ma.articles_id', '=', 'a.id')
            ->leftJoin('users as u', 'u.id', '=', 'm.userAdd')
            ->where('m.supprimer', 0)
            ->where('ma.supprimer', 0)
            ->when(!empty($filters['type']), function ($query) use ($filters) {
                $query->where('m.type', $filters['type']);
            })
            ->when(!empty($filters['date_debut']), function ($query) use ($filters) {
                $query->whereDate('m.date_mouvement', '>=', $filters['date_debut']);
            })
            ->when(!empty($filters['date_fin']), function ($query) use ($filters) {
                $query->whereDate('m.date_mouvement', '<=', $filters['date_fin']);
            })
            ->when(!empty($filters['articles_id']), function ($query) use ($filters) {
                $query->where('ma.articles_id', $filters['articles_id']);
            })
            ->when(!empty($filters['reference']), function ($query) use ($filters) {
                $query->where('m.reference', 'like', '%' . $filters['reference'] . '%');
            })
            ->select(
                'm.id',
                'ma.id as mouvement_article_id',
                'm.reference',
                'm.type',
                'm.date_mouvement',
                'm.observation',
                'm.userAdd',
                'm.created_at',
                'a.libelle as article',
                'a.code',
                'a.unite',
                'ma.quantite',
                DB::raw("COALESCE(NULLIF(TRIM(CONCAT(COALESCE(u.nom, ''), ' ', COALESCE(u.prenoms, ''))), ''), u.email, CONCAT('#', m.userAdd), '-') as operateur"),
                DB::raw('ABS(ma.quantite) as quantite_affichee')
            )
            ->orderBy('m.date_mouvement', 'desc')
            ->orderBy('m.id', 'desc')
            ->orderBy('ma.id', 'desc')
            ->simplePaginate($perPage)
            ->withQueryString();
    }

    public static function detail($id)
    {
        return DB::table('mouvementsarticles as ma')
            ->join('articles as a', 'ma.articles_id', '=', 'a.id')
            ->leftJoin('users as u', 'u.id', '=', 'ma.userAdd')
            ->where('ma.mouvements_id', $id)
            ->where('ma.supprimer', 0)
            ->select('ma.*', 'a.libelle as article', 'a.code', 'a.unite', DB::raw("COALESCE(NULLIF(TRIM(CONCAT(COALESCE(u.nom, ''), ' ', COALESCE(u.prenoms, ''))), ''), u.email, CONCAT('#', ma.userAdd), '-') as operateur"))
            ->orderBy('a.libelle')
            ->get();
    }

    public static function liste(){
        return DB::table('mouvements as m')
            ->where('m.supprimer', 0)
            ->get();
    }
}

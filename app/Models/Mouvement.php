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

    public static function mouvements($filters = [])
    {
        return DB::table('mouvements as m')
            ->join('mouvementsarticles as ma', 'ma.mouvements_id', '=', 'm.id')
            ->join('articles as a', 'ma.articles_id', '=', 'a.id')
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
                'm.reference',
                'm.type',
                'm.date_mouvement',
                'm.observation',
                'm.created_at',
                DB::raw('COUNT(ma.id) as nombre_lignes'),
                DB::raw('SUM(ABS(ma.quantite)) as quantite_totale'),
                DB::raw("GROUP_CONCAT(a.libelle ORDER BY a.libelle SEPARATOR ', ') as articles")
            )
            ->groupBy('m.id', 'm.reference', 'm.type', 'm.date_mouvement', 'm.observation', 'm.created_at')
            ->orderBy('m.date_mouvement', 'desc')
            ->orderBy('m.id', 'desc')
            ->get();
    }

    public static function detail($id)
    {
        return DB::table('mouvementsarticles as ma')
            ->join('articles as a', 'ma.articles_id', '=', 'a.id')
            ->where('ma.mouvements_id', $id)
            ->where('ma.supprimer', 0)
            ->select('ma.*', 'a.libelle as article', 'a.code', 'a.unite')
            ->orderBy('a.libelle')
            ->get();
    }

    public static function liste(){
        return DB::table('mouvements as m')
            ->where('m.supprimer', 0)
            ->get();
    }
}

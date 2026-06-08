<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $permissions = [
            'Voir la liste des articles',
            'Ajouter un article',
            'Modifier un article',
            'Supprimer un article',
            'Voir la liste des mouvements d articles',
            'Ajouter une entrée d articles',
            'Ajouter une sortie d articles',
            'Voir le détail d un mouvement',
            'Supprimer ou annuler un mouvement',
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission, 'guard_name' => 'web'],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }
    }

    public function down(): void
    {
        DB::table('permissions')->whereIn('name', [
            'Voir la liste des articles',
            'Ajouter un article',
            'Modifier un article',
            'Supprimer un article',
            'Voir la liste des mouvements d articles',
            'Ajouter une entrée d articles',
            'Ajouter une sortie d articles',
            'Voir le détail d un mouvement',
            'Supprimer ou annuler un mouvement',
        ])->delete();
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mouvements', function (Blueprint $table) {
            $table->index(['supprimer', 'date_mouvement', 'id'], 'mouvements_supprimer_date_id_index');
            $table->index(['supprimer', 'type', 'date_mouvement'], 'mouvements_supprimer_type_date_index');
        });

        Schema::table('mouvementsarticles', function (Blueprint $table) {
            $table->index(['mouvements_id', 'supprimer'], 'mouvementsarticles_mouvement_supprimer_index');
            $table->index(['supprimer', 'articles_id', 'mouvements_id'], 'mouvementsarticles_supprimer_article_mouvement_index');
        });
    }

    public function down(): void
    {
        Schema::table('mouvementsarticles', function (Blueprint $table) {
            $table->dropIndex('mouvementsarticles_mouvement_supprimer_index');
            $table->dropIndex('mouvementsarticles_supprimer_article_mouvement_index');
        });

        Schema::table('mouvements', function (Blueprint $table) {
            $table->dropIndex('mouvements_supprimer_date_id_index');
            $table->dropIndex('mouvements_supprimer_type_date_index');
        });
    }
};

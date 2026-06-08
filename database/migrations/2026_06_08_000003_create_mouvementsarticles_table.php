<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mouvementsarticles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mouvements_id');
            $table->unsignedBigInteger('articles_id');
            $table->integer('quantite');
            $table->unsignedBigInteger('userAdd')->nullable();
            $table->unsignedBigInteger('userUpdate')->nullable();
            $table->unsignedBigInteger('userDelete')->nullable();
            $table->boolean('supprimer')->default(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('mouvements_id')->references('id')->on('mouvements')->cascadeOnDelete();
            $table->foreign('articles_id')->references('id')->on('articles')->cascadeOnDelete();
            $table->index(['articles_id', 'supprimer']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mouvementsarticles');
    }
};

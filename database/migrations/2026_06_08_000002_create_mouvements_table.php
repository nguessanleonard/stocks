<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('type', 20);
            $table->date('date_mouvement');
            $table->text('observation')->nullable();
            $table->unsignedBigInteger('userAdd')->nullable();
            $table->unsignedBigInteger('userUpdate')->nullable();
            $table->unsignedBigInteger('userDelete')->nullable();
            $table->boolean('supprimer')->default(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->index(['type', 'date_mouvement']);
            $table->index('reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mouvements');
    }
};

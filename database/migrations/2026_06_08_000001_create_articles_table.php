<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('code')->unique();
            $table->string('unite')->nullable();
            $table->integer('stock_minimum')->default(0);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('userAdd')->nullable();
            $table->unsignedBigInteger('userUpdate')->nullable();
            $table->unsignedBigInteger('userDelete')->nullable();
            $table->boolean('supprimer')->default(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

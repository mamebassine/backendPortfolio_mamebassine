<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // Titre du projet
            $table->text('description'); // Description détaillée du projet
            $table->date('date_debut')->nullable(); // Date de début du projet
            $table->date('date_fin')->nullable(); // Date de fin du projet
            $table->string('lien')->nullable(); // Lien vers la démo ou le code source
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};

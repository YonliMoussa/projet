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
        Schema::create('demande_pieces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('piece_id')->constrained();
            $table->foreignId('demande_id')->constrained();
            $table->string('chemin_fichier', 100);
            $table->string('nom_fichier', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_pieces');
    }
};

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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('prenom');
            $table->string('nom');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('sexe');
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->string('situation_matrimoniale');
            $table->integer('nombre_enfants')->nullable();
            $table->string('region_naissance');
            $table->string('adresse');
            $table->boolean('boursier')->default(false);
            $table->string('nationalite');
            $table->string('nom_complet_mere');
            $table->string('nom_complet_pere');
            $table->boolean('handicap')->default(false);
            $table->boolean('is_chronique')->default(false);
            $table->string('casier_judiciaire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};

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
        Schema::table('realisation_projets', function (Blueprint $table) {
            $table->date('date_debut_realisation')->nullable();
            $table->date('date_fin_realisation')->nullable();
            $table->unsignedBigInteger('projet_id');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->unsignedBigInteger('etat_realisation_projet_id')->nullable();
            $table->foreign('etat_realisation_projet_id')->references('id')->on('etat_realisation_projets')->onDelete('cascade');            
            $table->unsignedBigInteger('personne_id')->nullable();
            $table->foreign('personne_id')->references('id')->on('personnes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realisation_projets', function (Blueprint $table) {
            $table->dropForeign(['apprenant_id']);
            $table->dropForeign(['etat_realisation_projet_id']);
            $table->dropForeign(['projet_id']);
            $table->dropColumn('date_debut_realisation');
            $table->dropColumn('date_fin_realisation');
            $table->dropColumn('projet_id');
            $table->dropColumn('etat_realisation_projet_id');
            $table->dropColumn('apprenant_id');
        });
    }
};

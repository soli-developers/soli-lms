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
        Schema::create('transfert_competences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projet_id');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->unsignedBigInteger('competence_id');
            $table->foreign('competence_id')->references('id')->on('competences')->onDelete('cascade');
            $table->unsignedBigInteger('appreciation_id');
            $table->foreign('appreciation_id')->references('id')->on('appreciations')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('transfert_competence_technologie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfert_competence_id');
            $table->foreign('transfert_competence_id')->references('id')->on('transfert_competences')->onDelete('cascade');
            $table->unsignedBigInteger('appreciation_id');
            $table->foreign('appreciation_id')->references('id')->on('appreciations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfert_competences');
        Schema::dropIfExists('transfert_competence_technologie');

    }
};

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
        Schema::create('appreciations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->float('noteMin');
            $table->float('noteMax');
            $table->unsignedBigInteger('niveau_competence_id');
            $table->foreign('niveau_competence_id')
                  ->references('id')
                  ->on('niveau_competences')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appreciations');
    }
};

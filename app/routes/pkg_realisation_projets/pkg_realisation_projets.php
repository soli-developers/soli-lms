<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_realisation_projets\ProjectRealisationController;
use App\Http\Controllers\pkg_realisation_projets\Apprenants;

// Routes for project realisation management
Route::middleware('auth')->group(function () {
    Route::resource('realisationProjets', ProjectRealisationController::class);
    Route::resource('apprenantRealisations', Apprenants::class);
    // Route::post('/apprenantRealisations', [Apprenants::class, 'store'])->name('apprenantRealisations.store'); 
});
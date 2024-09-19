<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_suivi\SuiviCompetencesController;

// Routes for project tracking management
Route::middleware('auth')->group(function () {
    Route::prefix('/suivi')->group(function () {
        Route::get('competences', [SuiviCompetencesController::class, 'index'])->name('suivi.competences');
    });
});



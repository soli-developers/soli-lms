<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_competences\NiveauCompetenceController;
use App\Models\pkg_competences\NiveauCompetence;

// routes for Module management
Route::middleware('auth')->group(function () {
    $namespace = 'App\Http\Controllers\pkg_competences';
    Route::namespace($namespace)->group(function () {
        Route::prefix('NiveauCompetence')->group(function () {
            Route::get('/', [NiveauCompetenceController::class, 'index'])->name('NiveauCompetence.index');
            Route::get('/NiveauCompetence/form-ajouter', [NiveauCompetenceController::class, 'create'])->name('NiveauCompetence.create');
            Route::post('/NiveauCompetence/ajouter', [NiveauCompetenceController::class, 'store'])->name('NiveauCompetence.store');
            Route::get('/NiveauCompetence/export', [NiveauCompetenceController::class, 'export'])->name('NiveauCompetence.export');
            Route::post('/NiveauCompetence/import', [NiveauCompetenceController::class, 'import'])->name('NiveauCompetence.import');
            Route::get('/NiveauCompetence/show/{id}', [NiveauCompetenceController::class, 'show'])->name('NiveauCompetence.show');
            Route::get('/NiveauCompetence/{id}/edit', [NiveauCompetenceController::class, 'edit'])->name('NiveauCompetence.edit');
            Route::put('/NiveauCompetence/{id}/update', [NiveauCompetenceController::class, 'update'])->name('NiveauCompetence.update');
            Route::delete('/NiveauCompetence/{id}/delete', [NiveauCompetenceController::class, 'destroy'])->name('NiveauCompetence.delete');
            });
    });
});

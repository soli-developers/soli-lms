<?php

use App\Models\User;
use App\Models\pkg_rh\NiveauScolaire;
use App\Models\pkg_rh\Formateur;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_rh\NiveauxScolaireController;


Route::middleware('auth')->group(function () {
        Route::prefix('NiveauxScolaire')->group(function () {
            Route::get('/', [NiveauxScolaireController::class, 'index'])->name('NiveauxScolaire.index');
            Route::get('/create', [NiveauxScolaireController::class, 'create'])->name('NiveauxScolaire.create');
            Route::post('/store', [NiveauxScolaireController::class, 'store'])->name('NiveauxScolaire.store');
            Route::get('/show/{id}', [NiveauxScolaireController::class, 'show'])->name('NiveauxScolaire.show');
            Route::get('/{id}/edit', [NiveauxScolaireController::class, 'edit'])->name('NiveauxScolaire.edit');
            Route::post('/{id}/update', [NiveauxScolaireController::class, 'update'])->name('NiveauxScolaire.update');
            Route::delete('/{id}/delete', [NiveauxScolaireController::class, 'destroy'])->name('NiveauxScolaire.delete');
            Route::get('/export', [NiveauxScolaireController::class, 'export'])->name('NiveauxScolaire.export');
            Route::post('/import', [NiveauxScolaireController::class, 'import'])->name('NiveauxScolaire.import');    
        });
});

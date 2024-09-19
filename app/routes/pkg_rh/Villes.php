<?php

use App\Models\User;
use App\Models\pkg_rh\Ville;
use App\Models\pkg_rh\Formateur;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_rh\VilleController;


Route::middleware('auth')->group(function () {
        Route::prefix('Villes')->group(function () {
            Route::get('/', [VilleController::class, 'index'])->name('Villes.index');
            Route::get('/create', [VilleController::class, 'create'])->name('Villes.create');
            Route::post('/store', [VilleController::class, 'store'])->name('Villes.store');
            Route::get('/show/{id}', [VilleController::class, 'show'])->name('Villes.show');
            Route::get('/{id}/edit', [VilleController::class, 'edit'])->name('Villes.edit');
            Route::post('/{id}/update', [VilleController::class, 'update'])->name('Villes.update');
            Route::delete('/{id}/delete', [VilleController::class, 'destroy'])->name('Villes.delete');
            Route::get('/export', [VilleController::class, 'export'])->name('Villes.export');
            Route::post('/import', [VilleController::class, 'import'])->name('Villes.import');    
        });
});

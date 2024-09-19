<?php

use App\Models\User;
use App\Models\pkg_rh\Groupes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_rh\GroupeController;


Route::middleware('auth')->group(function () {
        Route::prefix('Groupes')->group(function () {
            Route::get('/', [GroupeController::class, 'index'])->name('Groupes.index');
            Route::get('/create', [GroupeController::class, 'create'])->name('Groupes.create');
            Route::post('/store', [GroupeController::class, 'store'])->name('Groupes.store');
            Route::get('/show/{id}', [GroupeController::class, 'show'])->name('Groupes.show');
            Route::get('/{id}/edit', [GroupeController::class, 'edit'])->name('Groupes.edit');
            Route::post('/{id}/update', [GroupeController::class, 'update'])->name('Groupes.update');
            Route::delete('/{id}/delete', [GroupeController::class, 'destroy'])->name('Groupes.delete');
            Route::get('/export', [GroupeController::class, 'export'])->name('Groupes.export');
            Route::post('/import', [GroupeController::class, 'import'])->name('Groupes.import');    
        });
});

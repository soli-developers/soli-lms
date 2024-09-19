<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_formations\FormationController;

Route::prefix('formations')->group(function () {
    Route::get('/', [FormationController::class, 'index'])->name('formations.index');
    Route::get('/show/{id}', [FormationController::class, 'show'])->name('formations.show');
    Route::get('/edit/{id}', [FormationController::class, 'edit'])->name('formations.edit');
    Route::get('/create', [FormationController::class, 'create'])->name('formations.create');
    Route::post('/store', [FormationController::class, 'store'])->name('formations.store');
    Route::put('/update/{id}', [FormationController::class, 'update'])->name('formations.update');
    Route::delete('/destroy/{id}', [FormationController::class, 'destroy'])->name('formations.destroy');
    Route::get('/export', [FormationController::class, 'export'])->name('formations.export');
    Route::post('/import', [FormationController::class, 'import'])->name('formations.import');
});

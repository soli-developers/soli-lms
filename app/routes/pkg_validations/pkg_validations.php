<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_validations\ValidationController;

// Routes for validation management
Route::middleware('auth')->group(function () {
    // Route::resource('validations', ValidationController::class);
    Route::get('validations/validate/{realisation_id}', [ValidationController::class, 'show'])->name('validations.validate');
    Route::get('validations/detail/{realisation_id}', [ValidationController::class, 'detail'])->name('validations.detail');
    Route::post('validations/store/', [ValidationController::class, 'store'])->name('validations.store');
});
<?php

use App\Http\Controllers\PromocionesController;
use Illuminate\Support\Facades\Route;


Route::get('', [PromocionesController::class, "index"])->name('promociones.index');
Route::get('/{id}', [PromocionesController::class, "show"])->name('promociones.show');
Route::post('', [PromocionesController::class, "store"])->name('promociones.store');
Route::put('/{id}', [PromocionesController::class, "update"])->name('promociones.update');
Route::delete('/{id}', [PromocionesController::class, "destroy"])->name('promociones.destroy');
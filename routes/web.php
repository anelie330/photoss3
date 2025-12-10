<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [FirstController::class, 'index']);
Route::get("/{id}", [FirstController::class, 'album']) ->where("id", "[0-9]+");
Route::get('/{id}/filter', [FirstController::class, 'filterPhotos']);
Route::get("/ajout", [FirstController::class, 'ajout']);
Route::post("/ajout", [FirstController::class, 'store'])->name('ajout.store');
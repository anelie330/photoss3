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
Route::get('/filter', [FirstController::class, 'filterAlbums']);
Route::get("/{id}", [FirstController::class, 'album']) ->where("id", "[0-9]+");
Route::get('/ajoutAlbum', [FirstController::class, 'ajoutAlbum']);
Route::post('/ajoutAlbum', [FirstController::class, 'storeAlbum']);
Route::get('/{id}/filter', [FirstController::class, 'filterPhotos']);
Route::get("/ajout", [FirstController::class, 'ajout']);
Route::post("/ajout", [FirstController::class, 'store'])->name('ajout.store');
Route::delete('/photos/{id}', [FirstController::class, 'deletePhoto']);
Route::delete('/albums/{id}', [FirstController::class, 'deleteAlbum']);


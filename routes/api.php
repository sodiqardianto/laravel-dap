<?php

use App\Http\Controllers\Api\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/barang/search/', [BarangController::class, 'search']);
Route::get('/cek-nama', [BarangController::class, 'tesCekNama']);
Route::get('/cari-kata', [BarangController::class, 'tesCariKata']);
Route::get('/array-2d', [BarangController::class, 'tesCreateArrary2D']);
Route::apiResource('/barang', App\Http\Controllers\Api\BarangController::class);

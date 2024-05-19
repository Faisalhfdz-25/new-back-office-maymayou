<?php

use App\Http\Controllers\API\BahanBakuController;
use App\Http\Controllers\API\MenuController;
use App\Models\BahanBaku;
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

// //Menu routes API 
// Route::get('menu', [MenuController::class, 'index']);
// Route::post('menu', [MenuController::class,'store']);
// Route::get('menu/{id}',[MenuController::class, 'show']);
// Route::put('menu/{id}', [MenuController::class, 'update']);
// Route::delete('menu/{id}', [MenuController::class, 'destroy']);
// Route::get('menu/{id}/resep', [MenuController::class, 'showResep']);


// // Bahan Baku routes API

// Route::get('bahan-baku', [BahanBakuController::class, 'index']);
// Route::post('bahan-baku', [BahanBakuController::class, 'store']);
// Route::get('bahan-baku/{id}', [BahanBakuController::class, 'show']);
// Route::put('bahan-baku/{id}', [BahanBakuController::class, 'update']);
// Route::delete('bahan-baku/{id}', [BahanBakuController::class, 'destroy']);


<?php

use App\Http\Controllers\DepoimentoController;
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

Route::get('/depoimentos', [DepoimentoController::class, 'index']);
Route::post('/depoimentos', [DepoimentoController::class, 'store']);
//Route::put('/depoimentos/{depoimento}', [DepoimentoController::class, 'update']);
Route::put('/depoimentos/{depoimento}', [DepoimentoController::class, 'update']);
Route::delete('/depoimentos/{depoimento}', [DepoimentoController::class, 'destroy']);


Route::get('/depoimentos-home', [DepoimentoController::class, 'getDepoimentosHome']);




<?php

use App\Http\Controllers\EntradaController;
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

Route::get('/entradas/español', [EntradaController::class, 'descripciones']);
Route::get('/entradas/ingles', [EntradaController::class, 'descripciones_ingles']);
Route::get('/entradas/embera', [EntradaController::class, 'descripciones_embera']);
Route::get('/entradas/multimedias/{id}', [EntradaController::class, 'get_multimedia']);

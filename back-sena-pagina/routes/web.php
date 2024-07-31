<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\MultimediaEntradaController;
use App\Http\Controllers\UserControlller;

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

Route::get('/', function () {
    return redirect('/login');
});
// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::prefix('entradasBlog')->middleware('auth')->group(function(){
    Route::get('/inicio', function () {
        return view('welcome');
    });
    // Rutas para usuarios
    Route::resource('usuarios', UserControlller::class);
    
    
    // Rutas para autores
    Route::resource('autores', AutorController::class);
    
    
    // Rutas para entradas
    Route::resource('entradas', EntradaController::class);
    // Rutas para las multimedias entradas
    Route::post('entradas/multimedia', [MultimediaEntradaController::class, 'storeMultimedia'])->name('storeMultimedia');
    Route::delete('entradas/multimedia/{id}', [MultimediaEntradaController::class, 'destroyMultimedia'])->name('destroyMultimedia');
   //Ruta cerra sesion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

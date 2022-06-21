<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicacionesController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\EtiquetasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('publicaciones')->group(function () {
    Route::get('/',[ PublicacionesController::class, 'index']);
    Route::get('/gestion',[ PublicacionesController::class, 'indexGestion']);
    Route::get('/buscar',[ PublicacionesController::class, 'buscador']);
    Route::get('/carusel',[ PublicacionesController::class, 'carusel']);
    // Route::post('/store',[ PublicacionesController::class, 'store']);
    // Route::delete('/destroy',[ PublicacionesController::class, 'destroy']);
    Route::get('/{id}',[ PublicacionesController::class, 'show']);
    // Route::put('/update/{id}',[ PublicacionesController::class, 'update']);
});

Route::prefix('user')->group(function () {
    Route::post('/register',[ UsuarioController::class, 'register']);
    Route::post('/login',[ UsuarioController::class, 'login']);
    Route::post('/token',[ UsuarioController::class, 'generateToken']);
    Route::get('/session',[ UsuarioController::class, 'firstSesion']);
    // Route::post('/store',[ PublicacionesController::class, 'store']);
    // Route::delete('/destroy',[ PublicacionesController::class, 'destroy']);
    Route::get('/{id}',[ PublicacionesController::class, 'show']);
    // Route::put('/update/{id}',[ PublicacionesController::class, 'update']);
});

Route::prefix('etiquetas')->group(function () {
    Route::get('/',[ EtiquetasController::class, 'index']);
});

 Route::prefix('app')->group(function () {
    Route::post('/token',[ TokenController::class, 'generateToken']);
 });

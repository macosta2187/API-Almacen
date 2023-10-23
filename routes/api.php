<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PaqueteController;
use App\Http\Middleware\Autenticacion;
use Illuminate\Support\Facades\Route;

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


Route::post('/Almacen', [AlmacenController::class, 'Insertar'])->middleware(Autenticacion::class);
Route::get("/Almacen", [AlmacenController::class, "Listar"])->middleware(Autenticacion::class);
Route::delete('/Almacen/{id}', [AlmacenController::class, 'Eliminar'])->middleware(Autenticacion::class);
Route::post('/Almacen/{id}', [AlmacenController::class, 'Actualizar'])->middleware(Autenticacion::class);

Route::post('/Lote', [LoteController::class, 'Insertar'])->middleware(Autenticacion::class);
Route::get("/Lote", [LoteController::class, "Listar"])->middleware(Autenticacion::class);
Route::delete('/Lote/{id}', [LoteController::class, 'Eliminar'])->middleware(Autenticacion::class);
Route::put('/Lote/{id}', [LoteController::class, 'Actualizar'])->middleware(Autenticacion::class);

Route::post('/PaqueteLote', [LoteController::class, 'crearLotes'])->middleware(Autenticacion::class);
Route::post('/Paquete',[PaqueteController::class,"Insertar"])->middleware(Autenticacion::class);
Route::get('/Paquete',[PaqueteController::class,"Listar"])->middleware(Autenticacion::class);



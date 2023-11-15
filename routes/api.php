<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\EmpresaController;
use App\Http\Middleware\Autenticacion;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;



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
Route::match(['put', 'delete'],'/Lote/{id}', [LoteController::class, 'Actualizar'])->middleware(Autenticacion::class);

Route::post('/PaqueteLote', [LoteController::class, 'crearLotes'])->middleware(Autenticacion::class);
Route::post('/Paquete',[PaqueteController::class,"Insertar"])->middleware(Autenticacion::class);
Route::get('/Paquete',[PaqueteController::class,"Listar"])->middleware(Autenticacion::class);


Route::put('/PaqueteEstado/{id}', [LoteController::class, 'ActualizarEstado'])->middleware(Autenticacion::class);


Route::post('/empresaInsertar',[EmpresaController::class,"Insertar"])->middleware(Autenticacion::class);
Route::get('/empresa',[EmpresaController::class,"Listar"])->middleware(Autenticacion::class);
Route::get('/clienteci',[ClientesController::class,"Listar"])->middleware(Autenticacion::class);
Route::post('/cliente',[ClientesController::class,"Insertar"])->middleware(Autenticacion::class);


Route::get('/empleado',[EmpleadoController::class,"Listar"])->middleware(Autenticacion::class);
Route::get('/choferes',[EmpleadoController::class,"listarChoferes"])->middleware(Autenticacion::class);



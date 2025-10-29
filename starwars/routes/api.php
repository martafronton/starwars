<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanetaController;
use App\Http\Controllers\NaveController;
use App\Http\Controllers\PilotoController;
use App\Http\Controllers\MantenimientoController;


Route::get('mostrarPilotos', [PilotoController::class, 'mostrar_pilotos']);
Route::get('mostrarPiloto/{id}', [PilotoController::class, 'mostrar_piloto']);
Route::get('mostrarMantenimientos', [MantenimientoController::class, 'mostrar_mantenimientos']);
Route::get('mostrarMantenimiento/{id}', [MantenimientoController::class, 'mostrar_mantenimiento']);
Route::get('mostrarNaves', [NaveController::class, 'mostrar_naves']);
Route::get('mostrarPlaneta/{id}', [PlanetaController::class, 'mostrar_planeta']);
Route::get('mostrarPlanetas', [PlanetaController::class, 'mostrar_planetas']);
Route::get('mostrarPlaneta/{id}', [PlanetaController::class, 'mostrar_planeta']);
Route::post('asignar-nave', [PilotoController::class, 'asignarNave']);
Route::get('pilotosSinNave', [PilotoController::class, 'sinNave']);
Route::get('pilotosNave', [PilotoController::class, 'conNave']);
Route::get('pilotosActivos', [PilotoController::class, 'asignacionesActuales']);
Route::get('mantenimientoFecha', [MantenimientoController::class, 'mantenimientoFecha']);
Route::get('insertarNave', [NaveController::class, 'crear_nave']);
Route::get('mostrarNave/{id}', [NaveController::class, 'mostrar_nave']);
Route::put('modificarNave/{id}', [NaveController::class, 'modificar']);
Route::delete('eliminarNave/{id}', [NaveController::class, 'eliminar']);
Route::post("insertarPlaneta/", [PlanetaController::class, "crear_planeta"]);

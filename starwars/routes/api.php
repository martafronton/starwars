<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PlanetaController;
use App\Http\Controllers\NaveController;
use App\Http\Controllers\PilotoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\UsuarioController;

//Rutas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('nologin', function () {
    return response()->json(["success" => false, "message" => "No autorizado"], 403);
});

//Rutas protegidas
Route::middleware(['auth:sanctum', 'rol.usuario'])->group(function () {
    Route::get('mostrarPilotos', [PilotoController::class, 'mostrar_pilotos']);
    Route::get('mostrarPiloto/{id}', [PilotoController::class, 'mostrar_piloto']);
    Route::get('mostrarNaves', [NaveController::class, 'mostrar_naves']);
    Route::get('mostrarNave/{id}', [NaveController::class, 'mostrar_nave']);
    Route::get('mostrarPlanetas', [PlanetaController::class, 'mostrar_planetas']);
    Route::get('mostrarPlaneta/{id}', [PlanetaController::class, 'mostrar_planeta']);
    Route::get('mostrarMantenimientos', [MantenimientoController::class, 'mostrar_mantenimientos']);
    Route::get('mostrarMantenimiento/{id}', [MantenimientoController::class, 'mostrar_mantenimiento']);
    Route::get('pilotosSinNave', [PilotoController::class, 'sinNave']);
    Route::get('pilotosNave', [PilotoController::class, 'conNave']);
    Route::get('pilotosActivos', [PilotoController::class, 'asignacionesActuales']);
    Route::get('mantenimientoFecha', [MantenimientoController::class, 'mantenimientoFechas']);
    Route::post('logout', [AuthController::class, 'logout']);
});

//Rutas para gestor
Route::middleware(['auth:sanctum', 'rol.gestor'])->group(function () {
    Route::post('guardarMantenimiento', [MantenimientoController::class, 'guardar_mantenimiento']);
    Route::put('modificarMantenimiento/{id}', [MantenimientoController::class, 'modificar']);
    Route::delete('eliminarMantenimiento/{id}', [MantenimientoController::class, 'eliminar']);

    Route::post('asignar-nave', [PilotoController::class, 'asignarNave']);
    Route::post('desasociar-nave', [PilotoController::class, 'desasociarNave']);
    Route::post('crearPiloto', [PilotoController::class, 'crear_piloto']);
    Route::put('modificarPiloto/{id}', [PilotoController::class, 'modificar']);
    Route::delete('eliminarPiloto/{id}', [PilotoController::class, 'eliminar']);

    Route::post('insertarNave', [NaveController::class, 'crear_nave']);
    Route::put('modificarNave/{id}', [NaveController::class, 'modificar']);

    Route::post('insertarPlaneta', [PlanetaController::class, 'crear_planeta']);
    Route::put('modificarPlaneta/{id}', [PlanetaController::class, 'modificar']);
    Route::delete('eliminarNave/{id}', [NaveController::class, 'eliminar']);
    Route::delete('eliminarPlaneta/{id}', [PlanetaController::class, 'eliminar']);
});

//Rutas para admin
Route::middleware(['auth:sanctum', 'rol.admin'])->group(function () {
    Route::get('mostrarUsuarios', [UsuarioController::class, 'mostrarUsuarios']);
    Route::post('addUsuario', [UsuarioController::class, 'add_user']);
    Route::put('cambiarRol/{id}', [UsuarioController::class, 'cambiarRol']);
    Route::post('subir-imagen/{pilotoId}', [PilotoController::class, 'subirImagen']);
});





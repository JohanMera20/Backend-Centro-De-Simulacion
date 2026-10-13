<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SimulacionController;
use App\Http\Controllers\UsserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SimulacionEquipoController;
use App\Http\Controllers\SimulacionInsumoController;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register'])->name('api.v1.register');
Route::post('login', [AuthController::class, 'login'])->name('api.v1.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [AuthController::class, 'me'])->name('api.v1.me');
    Route::post('logout', [AuthController::class, 'logout'])->name('api.v1.logout');
});

Route::patch('ussers/{usser}/role', [UsserController::class, 'updateRole'])->name('api.v1.ussers.role');


Route::get('ambientes', [AmbienteController::class, 'index'])->name('api.v1.ambientes.index');
Route::post('ambientes', [AmbienteController::class, 'store'])->name('api.v1.ambientes.store');
Route::get('ambientes/{ambiente}', [AmbienteController::class, 'show'])->name('api.v1.ambientes.show');
Route::put('ambientes/{ambiente}', [AmbienteController::class, 'update'])->name('api.v1.ambientes.update');
Route::delete('ambientes/{ambiente}', [AmbienteController::class, 'destroy'])->name('api.v1.ambientes.destroy');


Route::get('equipos', [EquipoController::class, 'index'])->name('api.v1.equipos.index');
Route::post('equipos', [EquipoController::class, 'store'])->name('api.v1.equipos.store');
Route::get('equipos/{equipo}', [EquipoController::class, 'show'])->name('api.v1.equipos.show');
Route::put('equipos/{equipo}', [EquipoController::class, 'update'])->name('api.v1.equipos.update');
Route::delete('equipos/{equipo}', [EquipoController::class, 'destroy'])->name('api.v1.equipos.destroy');


Route::get('insumos', [InsumoController::class, 'index'])->name('api.v1.insumos.index');
Route::post('insumos', [InsumoController::class, 'store'])->name('api.v1.insumos.store');
Route::get('insumos/{insumo}', [InsumoController::class, 'show'])->name('api.v1.insumos.show');
Route::put('insumos/{insumo}', [InsumoController::class, 'update'])->name('api.v1.insumos.update');
Route::delete('insumos/{insumo}', [InsumoController::class, 'destroy'])->name('api.v1.insumos.destroy');


Route::get('reportes', [ReporteController::class, 'index'])->name('api.v1.reportes.index');
Route::post('reportes', [ReporteController::class, 'store'])->name('api.v1.reportes.store');
Route::get('reportes/{reporte}', [ReporteController::class, 'show'])->name('api.v1.reportes.show');
Route::put('reportes/{reporte}', [ReporteController::class, 'update'])->name('api.v1.reportes.update');
Route::delete('reportes/{reporte}', [ReporteController::class, 'destroy'])->name('api.v1.reportes.destroy');


Route::get('servicios', [ServicioController::class, 'index'])->name('api.v1.servicios.index');
Route::post('servicios', [ServicioController::class, 'store'])->name('api.v1.servicios.store');
Route::get('servicios/{servicio}', [ServicioController::class, 'show'])->name('api.v1.servicios.show');
Route::put('servicios/{servicio}', [ServicioController::class, 'update'])->name('api.v1.servicios.update');
Route::delete('servicios/{servicio}', [ServicioController::class, 'destroy'])->name('api.v1.servicios.destroy');


Route::get('simulacions', [SimulacionController::class, 'index'])->name('api.v1.simulacions.index');
Route::post('simulacions', [SimulacionController::class, 'store'])->name('api.v1.simulacions.store');
Route::get('simulacions/{simulacion}', [SimulacionController::class, 'show'])->name('api.v1.simulacions.show');
Route::put('simulacions/{simulacion}', [SimulacionController::class, 'update'])->name('api.v1.simulacions.update');
Route::delete('simulacions/{simulacion}', [SimulacionController::class, 'destroy'])->name('api.v1.simulacions.destroy');


Route::get('ussers', [UsserController::class, 'index'])->name('api.v1.ussers.index');
Route::post('ussers', [UsserController::class, 'store'])->name('api.v1.ussers.store');
Route::get('ussers/{usser}', [UsserController::class, 'show'])->name('api.v1.ussers.show');
Route::put('ussers/{usser}', [UsserController::class, 'update'])->name('api.v1.ussers.update');
Route::delete('ussers/{usser}', [UsserController::class, 'destroy'])->name('api.v1.ussers.destroy');

Route::get('roles', [RoleController::class, 'index'])->name('api.v1.roles.index');
Route::post('roles', [RoleController::class, 'store'])->name('api.v1.roles.store');
Route::get('roles/{role}', [RoleController::class, 'show'])->name('api.v1.roles.show');
Route::put('roles/{role}', [RoleController::class, 'update'])->name('api.v1.roles.update');
Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('api.v1.roles.destroy');


Route::get('simulacion_equipos', [SimulacionEquipoController::class, 'index'])->name('api.v1.simulacion_equipos.index');
Route::post('simulacion_equipos', [SimulacionEquipoController::class, 'store'])->name('api.v1.simulacion_equipos.store');
Route::get('simulacion_equipos/{simulacion_equipo}', [SimulacionEquipoController::class, 'show'])->name('api.v1.simulacion_equipos.show');
Route::put('simulacion_equipos/{simulacion_equipo}', [SimulacionEquipoController::class, 'update'])->name('api.v1.simulacion_equipos.update');
Route::delete('simulacion_equipos/{simulacion_equipo}', [SimulacionEquipoController::class, 'destroy'])->name('api.v1.simulacion_equipos.destroy');


Route::get('simulacion_insumos', [SimulacionInsumoController::class, 'index'])->name('api.v1.simulacion_insumos.index');
Route::post('simulacion_insumos', [SimulacionInsumoController::class, 'store'])->name('api.v1.simulacion_insumos.store');
Route::get('simulacion_insumos/{simulacion_insumo}', [SimulacionInsumoController::class, 'show'])->name('api.v1.simulacion_insumos.show');
Route::put('simulacion_insumos/{simulacion_insumo}', [SimulacionInsumoController::class, 'update'])->name('api.v1.simulacion_insumos.update');
Route::delete('simulacion_insumos/{simulacion_insumo}', [SimulacionInsumoController::class, 'destroy'])->name('api.v1.simulacion_insumos.destroy');
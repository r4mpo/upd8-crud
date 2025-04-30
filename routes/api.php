<?php

use App\Http\Controllers\CidadesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\Relatorios\RepresentantesCidadesController;
use App\Http\Controllers\Relatorios\RepresentantesClientesController;
use App\Http\Controllers\Renders\ComboBoxCidadesController;
use App\Http\Controllers\Renders\ComboBoxEstadosController;
use App\Http\Controllers\RepresentantesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::controller(AuthController::class)->prefix('usuario')->group(function () {
    Route::post('login', 'login');
    Route::post('registrar', 'registrar');
    Route::get('detalhar', 'detalhar')->middleware('token');
    Route::get('logout', 'logout')->middleware('token');
});

Route::middleware('token')->group(function(){
    Route::apiResource('cidades', CidadesController::class);
    Route::apiResource('clientes', ClientesController::class);
    Route::apiResource('representantes', RepresentantesController::class);

    Route::prefix('renders')->group(function(){
        Route::get('combo-box-estados', [ComboBoxEstadosController::class, 'renderizar']);
        Route::get('combo-box-cidades', [ComboBoxCidadesController::class, 'renderizar']);
    });

    Route::prefix('relatorios')->group(function(){
        Route::get('representantes-por-id-cliente/{id}', [RepresentantesClientesController::class, 'index']);
        Route::get('representantes-por-id-cidade/{id}', [RepresentantesCidadesController::class, 'index']);
    });
});
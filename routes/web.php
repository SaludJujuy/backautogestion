<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Xeilon\Controlador_Prestador;
use App\Http\Controllers\Xeilon\Controlador_Tramite;
use App\Http\Controllers\Prueba\Controlador_Prestador_Prueba;
use App\Http\Controllers\Prueba\Controlador_Tramite_Prueba;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['web'])->group(function () {
    // tus rutas que usan CSRF y cookies
    Route::get('/prestador/buscar', [Controlador_Prestador::class, 'buscar_prestador']);
    Route::post('/tramite/agregar', [Controlador_Tramite::class, 'registrar_tramite']);

    Route::get('/prestador/prueba/buscar', [Controlador_Prestador_Prueba::class, 'buscar_prestador_prueba']);
    Route::post('/tramite/prueba/agregar', [Controlador_Tramite_Prueba::class, 'registrar_tramite']);
});

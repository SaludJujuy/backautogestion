<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Xeilon\Controlador_Prestador;
use App\Http\Controllers\Xeilon\Controlador_Tramite;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/prestador/buscar', [Controlador_Prestador::class, 'buscar_prestador']);
Route::post('/tramite/agregar', [Controlador_Tramite::class, 'registrar_tramite']);
Route::post('/tramite/imprimir', [Controlador_Tramite::class, 'imprimir']);
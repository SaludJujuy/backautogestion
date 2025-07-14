<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Xeilon\Controlador_Prestador;
use App\Http\Controllers\Prueba\Controlador_Prestador_Prueba;
use App\Http\Controllers\Prueba\Controlador_Tramite_Prueba;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/prestador/buscar', [Controlador_Prestador::class, 'buscar_prestador']);
Route::get('/prestador/prueba/buscar',[Controlador_Prestador_Prueba::class, 'buscar_prestador_prueba']);
Route::post('/tramite/prueba/agregar',[Controlador_Tramite_Prueba::class, 'registrar_tramite']);
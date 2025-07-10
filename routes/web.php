<?php

use Illuminate\Support\Facades\Route;
USE App\Http\Controllers\Xeilon\Controlador_Prestador;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prestador/buscar', [Controlador_Prestador::class, 'buscar_prestador']);
    //->name('prestador.buscar')
    //->middleware('auth'); // Assuming you want to protect this route with authentication
<?php

namespace App\Http\Controllers\Prueba;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prueba\Tramite;
class Controlador_Tramite_Prueba extends Controller
{
    public function registrar_tramite(Request $request){
        $id = $request->input('prestador');
        $sobre = $request->input('sobre');
        $consulta = $request->input('consulta');
        $practica = $request->input('practica');
        $tramite = new Tramite();
        $tramite->insertar_tramite($id,$sobre,$consulta,$practica);
        return response()->json(['message'=>'tramite registrado']);
    }
}

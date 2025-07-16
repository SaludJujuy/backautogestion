<?php

namespace App\Http\Controllers\Xeilon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Controlador_Tramite extends Controller
{
    public function registrar_tramite(Request $request){
        dd("ingreso a registrar_tramite");
        $id = $request->input('prestador');
        $sobre = $request->input('sobre');
        $consulta = $request->input('consulta');
        $practica = $request->input('practica');
        
        $tramite = new Tramite();
        $tramite->insertar_tramite($id,$sobre,$consulta,$practica);
        return response()->json(['message'=>'tramite registrado']);
    }
}

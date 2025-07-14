<?php

namespace App\Http\Controllers\Prueba;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prueba\Prestador;

class Controlador_Prestador_Prueba extends Controller
{
    public function buscar_prestador_prueba(Request $request)
    {
        $param = $request->input('matricula');
        $prestador = new Prestador();
        $result = $prestador->buscar_prestador_prueba($param);

        if ($result) {
            return response()->json($result, 200);
        } else {
            return response()->json(['message' => 'Prestador no encontrado'], 404);
        }
    }
}

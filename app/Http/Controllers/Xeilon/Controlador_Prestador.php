<?php

namespace App\Http\Controllers\Xeilon;

use App\Http\Controllers\Controller;
use App\Models\Xeilon\Prestador;
use Illuminate\Http\Request;

class Controlador_Prestador extends Controller
{
    public function buscar_prestador(Request $request)
    {
        $param = $request->input('matricula');
        $prestador = new Prestador();
        $result = $prestador->buscar_afiliado($param);

        if ($result) {
            return response()->json($result, 200);
        } else {
            return response()->json(['message' => 'Prestador no encontrado'], 404);
        }
    }
}

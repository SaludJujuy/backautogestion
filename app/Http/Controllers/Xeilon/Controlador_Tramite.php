<?php

namespace App\Http\Controllers\Xeilon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Xeilon\Tramite;
use App\Models\Xeilon\Prestador;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use DateTime;

class Controlador_Tramite extends Controller
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

    public function imprimir_tramite(Request $request){
        $tramiteId = $request->input('tramite_id',1);
        $copias = $request->input('copias', 2);
        
        $id = $request->input('prestador',11043);
        $sobre = $request->input('sobre',0);
        $consulta = $request->input('consulta',0);
        $practica = $request->input('practica',0);
        $prestador = new Prestador();
        $prestador = $prestador->buscar_prestador_por_id($id);
         
        $fecha = Carbon::now()->format('Y-m-d H:i');

        $tramite = [
            'id' => $tramiteId,
            'prestador' => $prestador->Nombre,  
            'matricula' => $prestador->Matricula,
            'sobre' => $sobre,
            'consulta' => $consulta,
            'practica' => $practica,
            'fecha' => $fecha,
        ];   

        self::imprimir_comprobante($tramite, $copias);
        //simulacion de los datos del tramite 

        return response()->json($resultado);
    }



    public function imprimir(Request $request)
    {
        $tramiteId = $request->input('tramite_id');
        $copias = $request->input('copias', 2);
        $id = $request->input('prestador',11043);
        $sobre = $request->input('sobre',0);
        $consulta = $request->input('consulta',0);
        $practica = $request->input('practica',0);
        $prestador = new Prestador();
        $prestador = $prestador->buscar_prestador_por_id($id);
        $fecha = Carbon::now()->format('Y-m-d H:i');
        $tramite = [
            'id' => $tramiteId,
            'prestador' => $prestador->Nombre,  
            'matricula' => $prestador->Matricula,
            'nro_sobre' => $sobre,
            'consultas' => $consulta,
            'practicas' => $practica,
            'fecha' => $fecha,
        ];
        

        $contenido = $this->formatearComprobante($tramite);

        $nombreBase = 'tramite_' . $tramiteId . '_' . time();
        //$rutaDestino = storage_path('app/impresiones');
        //$rutaDestino = '\\\\10.0.0.176\\comprobantes_para_imprimir';



        $rutaDestino = 'C:\\Users\\PC\\Documents\\comprobantes_autogestion';
        //$nombreArchivo = "tramite_{$tramiteId}_copia$i.txt";
        //File::put("$rutaDestino\\$nombreArchivo", $contenido);

        if (!File::exists($rutaDestino)) {
            File::makeDirectory($rutaDestino, 0755, true);
        }

        // Generar el archivo 2 veces (dos copias)
        for ($i = 1; $i <= $copias; $i++) {
            $nombreArchivo = "$nombreBase-copia$i.txt";
            File::put("$rutaDestino/$nombreArchivo", $contenido);
        }

        return response()->json(['success' => true, 'mensaje' => 'Impresión generada']);
    }

    private function formatearComprobante($tramite)
    {
        return <<<EOT
        -------------------------------
        TRÁMITE DE AUTOGESTIÓN
        -------------------------------
        Prestador: {$tramite['prestador']}
        Fecha: {$tramite['fecha']}
        Nro Sobre: {$tramite['nro_sobre']}
        Consultas: {$tramite['consultas']}
        Prácticas: {$tramite['practicas']}

        Gracias por su gestión.
        -------------------------------
        EOT;
    }
}

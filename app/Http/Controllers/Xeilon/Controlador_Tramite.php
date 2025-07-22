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
        $tramiteId = $request->input('tramite_id', 1);
        $id = $request->input('prestador');
        $sobre = $request->input('sobre');
        $consulta = $request->input('consulta');
        $practica = $request->input('practica');

        $prestador = (new Prestador())->buscar_prestador_por_id($id);
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

        // Formatear comprobante en texto plano
        $contenido = $this->formatearComprobante($tramite);

        return response($contenido, 200)
                ->header('Content-Type', 'text/plain');
    }



    public function imprimir(Request $request)
    {
        $tramiteId = $request->input('tramite_id', 1);
        $copias = $request->input('copias', 2);
        $id = $request->input('prestador', 11043);
        $sobre = $request->input('sobre', 0);
        $consulta = $request->input('consulta', 0);
        $practica = $request->input('practica', 0);

        $prestador = (new Prestador())->buscar_prestador_por_id($id);
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
        $rutaDestino = 'C:\\Users\\PC\\Documents\\comprobantes_autogestion';

        // Crear carpeta si no existe
        if (!File::exists($rutaDestino)) {
            File::makeDirectory($rutaDestino, 0755, true);
        }

        for ($i = 1; $i <= $copias; $i++) {
            $nombreArchivo = "$nombreBase-copia$i.txt";
            $rutaCompleta = "$rutaDestino\\$nombreArchivo";
            clearstatcache(); // Limpia caché de estado de archivos
            sleep(1); // Dale 1 segundo de gracia
            File::put($rutaCompleta, $contenido);
            if ($i === 1) {
                $batPath = "C:\\scripts\\imprimir_comprobante.bat";
                $comando = "\"$batPath\" \"$rutaCompleta\"";
                shell_exec($comando);
            }
            file_put_contents(storage_path('logs/comprobante_contenido.txt'), $contenido);
        }

        return response()->json(['success' => true, 'mensaje' => 'Impresión generada']);
    }

    private function formatearComprobante($tramite)
    {
        return 
        <<<EOT
        
        TRÁMITE DE AUTOGESTIÓN
        ------------------------
        Cuenta: {$tramite['matricula']}
        Prestador: {$tramite['prestador']}
        Fecha: {$tramite['fecha']}
        Nro Sobre: {$tramite['nro_sobre']}
        Nro Consultas: {$tramite['consultas']}
        Nro Prácticas: {$tramite['practicas']}

        ------------------------
        La presente documentacion se encuentra sujeta a verificacion 
        de auditoria medica y contable, y no implica reconomcimiento 
        de credito alguno ni convaliacion de los montos a favor del 
        representante
        ------------------------
        Documentacion entregada fuera de termino, Sr. Prestador sus 
        ordenes ingresaran al circuito de facturacion el procimo mes
        ------------------------
        COMPROBANTE PARA ADJUNTAR A LA DOCUMENTACION
        EOT;
    }
}

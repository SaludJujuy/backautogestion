<?php

namespace App\Models\Xeilon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use DateTime;

class Tramite extends Model
{
    protected $connection = 'xeilon';

    static function insertar_tramite($id, $sobre, $consulta, $practica) {
        return DB::connection('xeilon')
            ->table('tramite_autogestion')
            ->insert([
                'IDPrestador' => $id,
                'Fecha' => Carbon::now()->format('Y-m-d H:i'),
                'NroSobre' => $sobre,
                'cantidadConsultas' => $consulta,
                'cantidadPracticas' => $practica
            ]);
    }

    static function imprimir_comprobante($tramite, $copia){
        $contenido = <<<EOT
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

        $nombreBase = 'tramite_' . $tramite['id'] . '_' . time();
        $rutaDestino = storage_path('app/impresiones');

        if (!File::exists($rutaDestino)) {
            File::makeDirectory($rutaDestino, 0755, true);
        }

        for ($i = 1; $i <= $copias; $i++) {
            $nombreArchivo = "$nombreBase-copia$i.txt";
            File::put("$rutaDestino/$nombreArchivo", $contenido);
        }
    }
}

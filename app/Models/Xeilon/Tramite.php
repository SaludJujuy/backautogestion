<?php

namespace App\Models\Xeilon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Tramite extends Model
{
    protected $connection = 'xeilon';

    static function insertar_tramite($id, $sobre, $consulta, $practica) {

       dd("ingreso a insertar_tramite");
        
        return DB::connection('xeilon')
            ->table('tramite_autogestion as ta')
            ->insert([
                'ta.IDPrestador' => $id,
                'ta.NroSobre' => $sobre,
                'ta.cantidadConsultas' => $consulta,
                'ta.cantidadPracticas' => $practica
            ]);
    }
}

<?php

namespace App\Models\Xeilon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tramite extends Model
{
    protected $connection = 'xeilon';

    static function insertar_tramite($id, $sobre, $consulta, $practica) {

        dd('Inserting tramite with parameters:', [
            'IdPrestador' => $id,
            'numero_sobre' => $sobre,
            'cantidad_consulta' => $consulta,
            'cantidad_practica' => $practica
        ]);
        
        return DB::connection('xeilon')
            ->table('tramite_autogestion as ta')
            ->insert([
                'ta.IDPrestador' => $id,
                'ta.NroSobre' => $sobre,
                'ta.cantidadConsulta' => $consulta,
                'ta.cantidadPractica' => $practica
            ]);
    }
}

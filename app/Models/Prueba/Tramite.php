<?php

namespace App\Models\Prueba;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Tramite extends Model
{
    static function insertar_tramite($id,$sobre,$consulta,$practica){
        return DB::table('tramite_autogestion as ta')
            ->insert([
                'ta.IdPrestador' -> $id,
                'ta.numero_sobre' -> $sobre,
                'ta.cantidad_consulta' -> $consulta,
                'ta.cantidad_practica' -> $practica
            ]);
    }
}

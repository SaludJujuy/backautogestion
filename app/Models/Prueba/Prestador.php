<?php

namespace App\Models\Prueba;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Prestador extends Model
{ 
    public function buscar_prestador_prueba($param){
        return $result = DB::table('prestadores as prest')
            ->join('medicomatricula as mm','mm.IdPrestador','=','prest.IdPrestador')
            ->select('*')
            ->where('mm.matricula',$param)
            ->first();
    }
}

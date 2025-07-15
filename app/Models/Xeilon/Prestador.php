<?php

namespace App\Models\Xeilon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Prestador extends Model
{
    protected $connection = 'xeilon';

    public function buscar_prestador($param){
        return $resutl = DB::connection($this->connection)
            ->table('prestadores as prest')
            ->join('medicomatricula as mm','mm.IdPrestador', '=', 'prest.IdPrestador')
            ->join('profesiones as prof','prof.IdProfesion','=','mm.IdProfesion')
            //->join('especialidadesprestador as ep','ep.IdPrestador','=','prest.IdPrestador')
            //->join('especialidadesvarias as espv','espv.IdEspecialidadVaria','=','ep.IdEspecialidadVaria')
            ->select(
                'prest.*',
                'mm.Matricula',
                'prof.Profesion',
                //'espv.*',
            )
            ->where('mm.Matricula','LIKE','%'. $param. '%')
            ->get();
    }
}

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
            ->select(
                'prest.*',
                'mm.Matricula',
                'prof.Profesion',
            )
            ->where('mm.Matricula','LIKE','%'. $param. '%')
            ->get();
    }

    public function buscar_prestador_por_id($param){
        return $resutl = DB::connection($this->connection)
            ->table('prestadores as prest')
            ->join('medicomatricula as mm','mm.IdPrestador', '=', 'prest.IdPrestador')
            ->join('profesiones as prof','prof.IdProfesion','=','mm.IdProfesion')
            ->select(
                'prest.*',
                'mm.Matricula',
                'prof.Profesion',
            )
            ->where('prest.IdPrestador',$param)
            ->first();
    }
}

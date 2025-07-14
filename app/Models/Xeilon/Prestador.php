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
            ->select('prest.*')
            ->where('mm.Matricula', $param)
            ->first();
    }
}

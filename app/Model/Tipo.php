<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tipo extends Model
{
    protected $table="tKxACTipo";

    public static function getTipos(){
        return Tipo::select('acTipo','acTipoExcel','acTipoAbreviado')->get();
    }
   
    public static function getTipoOrigem(){
        return DB::table('tKxACTipoOrigem')
                ->select('acTipo','acOrigem')
                ->where('acTipo','STSTSW')
                ->get();
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    public static function getClientes(){
        return DB::table('KC_Cliente')
                ->where('Carrega',1)
                ->get();
                //->paginate(30);
    }

    public static function getCabecalho(){
        return DB::select('SELECT KC_Credito.* FROM KC_Credito INNER JOIN KC_ClieCred ON KC_Credito.PeCodigo COLLATE Latin1_General_CI_AI = KC_ClieCred.PeCodigo Where Carrega = 1');
    }
}

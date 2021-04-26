<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Origem extends Model
{
    protected $table="tKxACOrigem";

    public static function getOrigens(){
        return Origem::select('acOrigem','acOTitulo','acODescricao','acODado')->get();
    }
}

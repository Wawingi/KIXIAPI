<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Utilizador extends Model
{
    protected $table="tKxUsUtilizador";

    public static function getUtilizadores(){
        return Utilizador::where('Activo',1)
                        ->select('UtCodigo','Nombre01','Nombre02','Nombre03','departamento','CorreioI','UtSenha','Imagen')
                        ->get();
    }

    //Pegar utilizador por ut codigo
    public static function getUtilizadorByUsername($username){
        return Utilizador::where('Activo',1)
                        ->where('UtCodigo',$username)
                        ->select('UtCodigo','Nombre01','Nombre02','Nombre03','departamento','CorreioI','UtSenha','Imagen')
                        ->first();
    }
}

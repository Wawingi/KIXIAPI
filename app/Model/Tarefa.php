<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $table='tKxACTarefa';

    protected $fillable=['acCodigo'];

    //Listar utilizadores registados no kixipedidos
    public static function exportarTarefas(){
        return Tarefa::select('Departamento','PraDepartamento','utCodigo','acResponsavel','utRegisto','acTitulo','acDescripcao','acAvanco','acTempo','acTipo','acOrigem','acOrigemDado','DataSolicitacao','DataPrevista','DataReativacao','DataCumprimento','DataEnvio','acCodigo','OfCodigo','PraOfCodigo','DataRegisto')
                    ->where('acAvanco','<',100)
                    //->where('acResponsavel','=','gede.dize')
                    ->get();
    }
}

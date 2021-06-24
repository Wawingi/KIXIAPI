<?php

namespace App\Imports;

use App\Model\Tarefa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TarefasImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        dd($row);
        return new Tarefa([
            'acCodigo' => $row['acCodigo'],
            'acOrigemArquivo' => $row['acOrigemArquivo'], 
            'acTipo' => $row['acTipo'], 
            'acOrigem' => $row['acOrigem'],
            'acOrigemDado' => $row['acOrigemDado'],
            'OfCodigo' => $row['OfCodigo'],    
            'Departamento' => $row['Departamento'],                                      
            'PraOfCodigo' => $row['PraOfCodigo'],
            'PraDepartamento' => $row['PraDepartamento'],                                    
            'utCodigo' => $row['utCodigo'],      
            'acTitulo' => $row['acTitulo'],                                                                              
            'acDescripcao' => $row['acDescripcao'],                                                                                                                                                                                                                                                    
            'acAvanco' => $row['acAvanco'],                              
            'DataSolicitacao' => $row['DataSolicitacao'],         
            'DataPrevista' => $row['DataPrevista'],            
            'DataReativacao' => $row['DataReativacao'],          
            'acResponsavel' => $row['acResponsavel'],
            'DataCumprimento' => $row['DataCumprimento'],         
            'DataEnvio' => $row['DataEnvio'],               
            'acTempo' => $row['acTempo'],
            'utRegisto' => $row['utRegisto'],       
            'DataRegisto' => $row['DataRegisto'],   
        ]);
    }
}

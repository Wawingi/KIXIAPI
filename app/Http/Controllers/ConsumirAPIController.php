<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Model\Operacao;
use App\Model\Utilizador;
use App\Model\Tipo;
use App\Model\Tarefa;
use App\Model\Origem;
//Use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TarefasImport;

class ConsumirAPIController extends Controller
{

    public function getTarefasAPI(){
        try {
            $client = new Client(); //GuzzleHttp\Client
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/getTarefasAPI";            
            $url = "http://kixiagenda.kixicredito.com/public/api/getTarefasAPI";  
                     
            $response = $client->request('GET', $url);        
                if($response->getStatusCode() == "200"){
                    return json_decode($response->getBody());
                }else{dd('kk');
                    return response()->json(['status',"error"]);
                }
        } catch (RequestException $e) {

        }
    }

    public function pegaTarefas(){
        $tarefas = $this->getTarefasAPI();
        return view('pages.listarTarefas', compact('tarefas'));      
    }

    public function salvarTarefa(){
        try{
            $tarefas = $this->getTarefasAPI();
            foreach($tarefas as $tarefa){
                if($tarefa->data_cumprimento==null) $dt_cumpimento=NULL; else $dt_cumpimento=date('Ymd H:i:s',strtotime($tarefa->data_cumprimento));
                if($tarefa->data_reactivacao==null) $dt_reactivacao=NULL; else $dt_reactivacao=date('Ymd H:i:s',strtotime($tarefa->data_reactivacao));
              
                if(DB::table('tKxACTarefa')->insert([ 
                    'acCodigo' => $tarefa->codigo,
                    'acOrigemArquivo' => $tarefa->versao_sistema, 
                    'acTipo' => $tarefa->id_tipo, 
                    'acOrigem' => $tarefa->id_origem,
                    'acOrigemDado' => $tarefa->origem_dado,
                    'OfCodigo' => $tarefa->id_dpto_origem,    
                    'Departamento' => $tarefa->departamento_origem,                                      
                    'PraOfCodigo' => $tarefa->id_dpto_destino,
                    'PraDepartamento' => $tarefa->departamento_destino,                                    
                    'utCodigo' => $tarefa->solicitante,      
                    'acTitulo' => $tarefa->titulo,                                                                              
                    'acDescripcao' => $tarefa->descricao,                                                                                                                                                                                                                                                    
                    'acAvanco' => $tarefa->avanco,                              
                    'DataSolicitacao' => date('Ymd H:i:s',strtotime($tarefa->data_solicitacao)),         
                    'DataPrevista' => date('Ymd H:i:s',strtotime($tarefa->data_prevista)),            
                    'DataReativacao' => $dt_reactivacao,          
                    'acResponsavel' => $tarefa->responsavel,
                    //'acDSOPeriodo' => $tarefa-> 
                    //'acDSOFeito' => $tarefa->
                    'DataCumprimento' => $dt_cumpimento,         
                    'DataEnvio' => date('Ymd H:i:s',strtotime($tarefa->data_envio)),               
                    'acTempo' => $tarefa->tempo,
                    'utRegisto' => $tarefa->ut_registo,       
                    'DataRegisto' => date('Ymd H:i:s',strtotime($tarefa->created_at))             
                    //'utReclamo' => $tarefa->       
                    //'DataReclamo' => $tarefa->
                ])){
                    $status = true;  
                }
            }
            if($status){
                return back()->with('sucesso','Registada com sucesso.');
            }
        } catch (Exception $e){
            return back()->with('error','Houve um erro ao registar actividade ou actividade já existente.');
        }
    }

    //Converter sigla estado para estado
    public function siglaToEstado($operacoes){
        foreach($operacoes as $op):   
            switch($op->estado){
                case 'ACCO':$op->estado = 'Actividade Concluída'; break;                  
                case 'ACCU':$op->estado = 'Actividade em Curso'; break;                  
                case 'ACRG':$op->estado = 'Actividade Reagendada'; break;                  
                case 'ACRT':$op->estado = 'Actividade Reativada'; break;                  
                case 'CUSS':$op->estado = 'Em Curso Solic. Suporte'; break;                  
                case 'CURS':$op->estado = 'Em Curso Resp. Suporte'; break;               
            }       
        endforeach;
        
        return $operacoes;
    }

    public function pegaOperacoes(){
        try {
            $client = new Client(); //GuzzleHttp\Client
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/getOperacaoAPI";
            $url = "http://kixiagenda.kixicredito.com/public/api/getOperacaoAPI";  

            $response = $client->request('GET', $url);
                if($response->getStatusCode() == "200"){
                    $operacoes = json_decode($response->getBody());
                    $operacoes = $this->siglaToEstado($operacoes);
                    return view('pages.listarOperacoes', compact('operacoes'));
                }else{
                    return response()->json(['status',"error"]);
                }
        } catch (ClientException $e) {
                 echo Psr7\str($e->getRequest());
                 echo Psr7\str($e->getResponse());
        }
    } 

    public function salvarAccao(){
        try {
            $client = new Client();
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/getOperacaoAPI";
            $url = "http://kixiagenda.kixicredito.com/public/api/getOperacaoAPI";
            $statusExist=0;
            $statusNovo=0;
            $response = $client->request('GET', $url);
                if($response->getStatusCode() == "200"){
                    $operacoes = json_decode($response->getBody());
                    foreach($operacoes as $op){ 
                        //Verificar se já existe uma acção registada                                       
                        $existOperacao=Operacao::select('acCodigo','acAvanco','DataOperacao')->where([['acCodigo','=',$op->codigo],['acAvanco','=',$op->avanco],['DataOperacao','=',date('Ymd H:i:s',strtotime($op->created_at))]])->count();
                        
                        //dd($existOperacao);
                        //dd($op);

                        if($existOperacao==0){
                            if(DB::table('tKxACTarefaOperacao')->insert([
                                'acCodigo' => $op->codigo,
                                'DataOperacao' => date('Ymd H:i:s',strtotime($op->created_at)),                                
                                'acOrigemDado' => $op->acOrigemDado,
                                'utCodigo' => $op->utilizador_codigo,
                                'Descricao' => $op->descricao,
                                'acEstado' => $op->estado,
                                'acAvanco' => $op->avanco,
                                'DataEnvio' => date('Ymd H:i:s',strtotime($op->created_at)),
                                'acTempo' => $op->tempo_acao,
                                'utRegisto' => $op->utilizador_registo,
                                'DataRegisto' => date('Ymd H:i:s',strtotime($op->created_at)),
                                'utPergunta' => $op->utilizador_pergunta
                            ])){ 
                               ++$statusNovo; 
                                /* DB::table('tKxACTarefa')          
                                ->where('acCodigo','=',$op->codigo)
                                ->update(['acAvanco' => $op->avanco]);

                                //Actividade cumprida
                                if($op->avanco==100){
                                    DB::table('tKxACTarefa')          
                                    ->where('acCodigo','=',$op->codigo)
                                    ->update(['DataCumprimento' => date('Ymd H:i:s',strtotime($op->updated_at))]);
                                }

                                //Actividade reagendada
                                if($op->estado=='ACRG'){
                                    DB::table('tKxACTarefa')          
                                    ->where('acCodigo','=',$op->codigo)
                                    ->update(['DataPrevista' => date('Ymd H:i:s',strtotime($op->created_at))]);
                                } */                                    
                            }
                        }else{
                            ++$statusExist;
                        }                      
                    }   
                    
                    return back()->with('sucesso',$statusNovo.' Acções registadas com sucesso. Houve '.$statusExist.' Acções Já existentes');
                    
                }else{
                    return back()->with('error','Erro ao registar acções.');
                }
        } catch (Exception $e) {
            return back()->with('error','Houve um erro ao registar acção ou actividade ainda não registada.');
        }
    }

    //Pega utilizadores registados no KixiAgenda
    public function pegaUtilizadoresKA(){
        try {
            $client = new Client();
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/getKixiagendaUtilizadoresAPI";
            $url = "http://kixiagenda.kixicredito.com/public/api/getKixiagendaUtilizadoresAPI";
           
            $response = $client->request('GET', $url);
                if($response->getStatusCode() == "200"){
                    return count(json_decode($response->getBody()));   
                }else{
                    return 0;
                }
        } catch (QueryException $e) {
        
        }
    }

    //Listar utilizadores registados no kixipedidos
    public function listarUtilizadores(){
        $Utilizadores = Utilizador::getUtilizadores();
        $contUtilizadoresKA = $this->pegaUtilizadoresKA();
        return view('pages.listarUtilizadores',compact('Utilizadores','contUtilizadoresKA'));
    }

    //Salvar utilizadores vindo do Kixipedidos para kixiagenda
    public function salvarUtilizadornoKA(){
        try {
            $client = new Client(); //GuzzleHttp\Client
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/registarUtilizadorAPI"; 
            $url = "http://kixiagenda.kixicredito.com/public/api/registarUtilizadorAPI";

            $Utilizadores = Utilizador::getUtilizadores();
            $contSucesso=0;

            foreach($Utilizadores as $utilizador){
                $response = $client->request('POST', $url, [
                    'form_params' => [
                        'UtCodigo' => $utilizador->UtCodigo,
                        'name' => $utilizador->Nombre01.' '.$utilizador->Nombre02.' '.$utilizador->Nombre03,
                        'departamento' => $utilizador->departamento,
                        'CorreioI' => $utilizador->CorreioI,
                        'UtSenha' => $utilizador->UtSenha,
                        'Imagen' =>  $utilizador->Imagen
                    ]
                ]);
                //dd($response);
                if($response->getStatusCode() == "200"){
                    $contSucesso++;
                }else{
                    //return response()->json(['status',"error"]);
                }
            }
            return back()->with('sucesso','Registados '.$contSucesso.' utilizadores.'); 
        } catch (RequestException $e) {
            echo GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo GuzzleHttp\Psr7\str($e->getResponse());
            }
        }
    }

    //Pega tipos registados no KixiAgenda
    public function pegaTiposKA(){
        try {
            $client = new Client();
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/getKixiagendaTipoAPI";
            $url = "http://kixiagenda.kixicredito.com/public/api/getKixiagendaTipoAPI";
            $response = $client->request('GET', $url);
                if($response->getStatusCode() == "200"){
                    return count(json_decode($response->getBody()));   
                }else{
                    return 0;
                }
        } catch (QueryException $e) {
        
        }
    }

    //Listar tipos de actividade registados no kixipedidos
    public function listarTipos(){
        $tipos = Tipo::getTipos();
        $contTiposKA =  $this->pegaTiposKA();
        return view('pages.listarTipos',compact('tipos','contTiposKA'));
    }

    //Salvar tipos vindo do Kixipedidos para kixiagenda
    public function salvarTiponoKA(){
        try {
            $client = new Client(); //GuzzleHttp\Client
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/registarTipoAPI"; 
            $url = "http://kixiagenda.kixicredito.com/public/api/registarTipoAPI";
            $tipos = Tipo::getTipos();
            $contSucesso=0;

            foreach($tipos as $tipo){
                $response = $client->request('POST', $url, [
                    'form_params' => [
                        'id' => $tipo->acTipo,
                        'tipo' => $tipo->acTipoExcel,
                        'tipo_abreviado' => $tipo->acTipoAbreviado,
                    ]
                ]);
                //dd($response);
                if($response->getStatusCode() == "200"){
                    $contSucesso++;
                }else{
                    //return response()->json(['status',"error"]);
                }
            }
            //return back()->with('sucesso','Registados '.$contSucesso.' tipos.'); 
        } catch (RequestException $e) {
            echo GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo GuzzleHttp\Psr7\str($e->getResponse());
            }
        }
    }

    //Pega tipos registados no KixiAgenda
    public function pegaOrigensKA(){
        try {
            $client = new Client();
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/getKixiagendaOrigemAPI";
            $url = "http://kixiagenda.kixicredito.com/public/api/getKixiagendaOrigemAPI";
            $response = $client->request('GET', $url);
                if($response->getStatusCode() == "200"){
                    return count(json_decode($response->getBody()));   
                }else{
                    return 0;
                }
        } catch (QueryException $e) {
        
        }
    }

    //Listar origens de actividade registados no kixipedidos
    public function listarOrigens(){
        $origens = Origem::getOrigens();
        $contOrigensKA = $this->pegaOrigensKA();
        return view('pages.listarOrigens',compact('origens','contOrigensKA'));
    }

    //Salvar origens vindo do Kixipedidos para kixiagenda
    public function salvarOrigemnoKA(){
        try {
            $client = new Client(); //GuzzleHttp\Client
            //$url = "http://192.168.5.83:8080/kixiagenda/public/api/registarOrigemAPI"; 
            $url = "http://kixiagenda.kixicredito.com/public/api/registarOrigemAPI";
            $origens = Origem::getOrigens();
            $contSucesso=0;

            foreach($origens as $origem){
                $response = $client->request('POST', $url, [
                    'form_params' => [
                        'id' => $origem->acOrigem,
                        'titulo' => $origem->acOTitulo,
                        'descricao' => $origem->acODescricao,
                        'dado' => $origem->acODado,
                    ]
                ]);
                //dd($response);
                if($response->getStatusCode() == "200"){
                    $contSucesso++;
                }else{
                    //return response()->json(['status',"error"]);
                }
            }
            //return back()->with('sucesso','Registados '.$contSucesso.' tipos.'); 
        } catch (RequestException $e) {
            echo GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo GuzzleHttp\Psr7\str($e->getResponse());
            }
        }
    }

    //Salvar origens vindo do Kixipedidos para kixiagenda
    public function salvarTipoOrigemnoKA(){
        try {
            $client = new Client(); //GuzzleHttp\Client
            $url = "http://192.168.5.83:8080/kixiagenda/public/api/registarTipoOrigem"; 
            $tipo_origem = Tipo::getTipoOrigem();
            $status;

            foreach($tipo_origem as $to){
                $response = $client->request('POST', $url, [
                    'form_params' => [
                        'id_tipo' => $to->acTipo,
                        'id_origem' => $to->acOrigem,
                    ]
                ]);
       
                if($response->getStatusCode() == "200"){
                    $status=true;
                }else{
                    $status=false;
                }
            }
            $status ? 'Sucesso': 'Erro';
        } catch (RequestException $e) {
            echo GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo GuzzleHttp\Psr7\str($e->getResponse());
            }
        }
    }

    //Salvar tarefas vindo do Kixipedidos para kixiagenda
    public function exportarTarefasParaKA(){
        try {
            $client = new Client(); //GuzzleHttp\Client
            $url = "http://192.168.5.83:8080/kixiagenda/public/api/sincronizarTarefas"; 
            $tarefas = Tarefa::exportarTarefas();
            $status;
            $cont=0;//dd($tarefas);

            foreach($tarefas as $tf){
                $response = $client->request('POST', $url, [
                    'form_params' => [
                        'departamento_origem' => $tf->Departamento,
                        'departamento_destino' => $tf->PraDepartamento,
                        'solicitante' => $tf->utCodigo,
                        'responsavel' => $tf->acResponsavel,
                        'ut_registo' => $tf->utRegisto,
                        'titulo' => $tf->acTitulo,
                        'descricao' => $tf->acDescripcao,
                        'avanco' => $tf->acAvanco,
                        'tempo' => $tf->acTempo,
                        'id_tipo' => $tf->acTipo,
                        'id_origem' => $tf->acOrigem,
                        'origem_dado' => $tf->acOrigemDado,
                        'data_solicitacao' => $tf->DataSolicitacao,
                        'data_prevista' => $tf->DataPrevista,
                        'data_reactivacao' => $tf->DataReativacao,
                        'data_cumprimento' => $tf->DataCumprimento,
                        'data_envio' => $tf->DataEnvio,
                        'codigo' => $tf->acCodigo,
                        'id_dpto_origem' => $tf->OfCodigo,
                        'id_dpto_destino' => $tf->PraOfCodigo,
                        'versao_sistema' => 'KAW100',
                        //'id_user' => 'f8b11db7-8b87-4d88-b5e6-01f14950afd5',
                        'created_at' => $tf->DataRegisto,
                        'updated_at' => $tf->DataRegisto,
                    ]
                ]);
       
                if($response->getStatusCode() == "200"){
                    $status=true;
                    $cont++;
                }else{
                    $status=false;
                }
            }
            $status ? 'Sucesso':'Erro';dd($cont);
        } catch (RequestException $e) {
            echo GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo GuzzleHttp\Psr7\str($e->getResponse());
            }
        }
    }

    public function importarTarefas(Request $request){
        //dd($request);
        Excel::import(new TarefasImport, $request->ficheiro);
        
        return redirect('/')->with('success', 'All good!');
    }

}

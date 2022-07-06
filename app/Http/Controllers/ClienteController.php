<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cliente;
use App\Model\Tarefa;
use GuzzleHttp\Client;
use File;
use Response;
//Use Exception;

class ClienteController extends Controller
{
    public function listarClientes(){
        $clientes = count(Cliente::getClientes());
        $cabecalhos = count(Cliente::getCabecalho());
        return view('pages.listarClientes',compact('clientes','cabecalhos'));
    }

    public function salvarClientesWeb(){
        try {
            $client = new Client(); //GuzzleHttp\Client
            $url = "http://192.168.5.83:8080/kixicliente/public/api/registarClientesAPI"; 
            //$url = "http://kixicliente.kixicredito.com/public/api/registarClientesAPI";

            $clientes = Cliente::getClientes();
            $contSucesso=0;$contFalha=0;
         
            foreach($clientes as $cliente){
                $response = $client->request('POST', $url, [
                    'form_params' => [
                        'codigo_credito' => $cliente->NroEmprestimo,
                        'codigo_membro' => $cliente->CodigoMembro,
                        'data_actualizacao' => $cliente->Atualizado,
                        'loan_number' => $cliente->LNR,
                        'nome' => $cliente->NomeMembro,
                        'telefone1' => $cliente->CeTelefono,
                        'telefone2' => $cliente->CeTelefono2,  
                        'bilhete' => $cliente->BI  
                    ]
                ]);
               
                if($response->getStatusCode() == "200"){
                    if(json_decode($response->getBody())==1){
                        ++$contSucesso;
                    }else{
                        ++$contFalha;
                    }
                }else{
                    ++$contFalha;
                }
            }
            return response()->json('Sincronizados: '.$contSucesso.' Erros: '.$contFalha,200);

        } catch (RequestException $e) {
            echo GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo GuzzleHttp\Psr7\str($e->getResponse());
            }
        }
    }

    public function gerarJSONClientes(){
        $clientes = Cliente::getClientes();

        $data = json_encode($clientes,JSON_PRETTY_PRINT);
        $jsongFile = date('d-m-Y') . '_clientes.json';
       
        File::put(public_path('/upload/json/'.$jsongFile), $data);

        return Response::download(public_path('/upload/json/'.$jsongFile));
    }

    public function gerarJSONCabecalho(){
        $cabecalhos = Cliente::getCabecalho();

        $data = json_encode($cabecalhos,JSON_PRETTY_PRINT);
        $jsonFile = date('d-m-Y') . '_cabecalhos.json';
       
        File::put(public_path('/upload/json/'.$jsonFile), $data);

        return Response::download(public_path('/upload/json/'.$jsonFile));
    }
}

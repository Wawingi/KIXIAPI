@extends('layouts.inicio')
@section('content1')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Enviar dados ao Kixiclientes</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Enviar Clientes</a></li>
                    </ol>
                </div>
                <h4 class="page-title">CLIENTES SELECIONADOS</h4>
            </div>
        </div>
    </div>

    <!-- validação de retornos -->
    @if(session('sucesso'))
    <div style="height:40px;background:#bdf7c9" class="alert icon-custom-alert  alert-outline-success b-round fade show" role="alert">                                            
        <div style="color:#000" class="alert-text">
            {{ session('sucesso')}}
        </div>        
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="mdi mdi-close text-danger"></i></span>
            </button>
        </div>
    </div> 
    @endif    
    @if(session('error')) 
    <div style="height:40px;background:#ffb459" class="alert icon-custom-alert  alert-outline-warning b-round fade show" role="alert">                                            
        <div style="color:#000" class="alert-text">
            {{ session('error')}}
        </div>        
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="mdi mdi-close text-danger"></i></span>
            </button>
        </div>
    </div>  
    @endif

    <div id="loader" class="loader">Loading...</div>

    <hr>
    <!-- Inicio do corpo -->
    <div class="card">
        <br>
        <div class="row">
            <div class="col-6">
                <h7 style="color:#18af85a1;font-size:16px">TOTAL DE CLIENTES: <b>{{$clientes}}</b></h7>
            </div>
           
            <div class="col-6">
                <a href="{{ url('exportarClientes') }}" class="btn btn-primary btn-sm btn-round float-right mr-1"><i class="ti-arrow-down mr-1"></i>Exportar Clientes (JSON)</a>
            </div>
        </div>
        <hr>        
        <div class="row">
            <div class="col-6">
                <h7 style="color:#18af85a1;font-size:16px">TOTAL DE CABEÇALHOS: <b>{{$cabecalhos}}</b></h7>
            </div>
           
            <div class="col-6">
            <a href="{{ url('exportarCabecalhos') }}" class="btn btn-primary btn-sm btn-round float-right mr-1"><i class="ti-arrow-down mr-1"></i>Exportar Cabeçalhos (JSON)</a>
            </div>
        </div><br>
    </div> 
    <!-- FIm do corpo -->
</div>
@stop
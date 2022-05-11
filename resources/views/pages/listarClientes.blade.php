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
        <div class="row">
            <div class="col-lg-6"><br>
                <h7 style="color:#18af85a1;font-size:16px">TOTAL DE CLIENTES LOCAL: <b>{{count($clientes)}}</b></h7>
            </div>
           
            <div class="col-lg-6"><br>
                <a href="#" class="salvarClientes btn btn-success btn-sm btn-round float-right"><i class="ti-arrow-up mr-1"></i>Enviar Web<a>
                <a href="{{ url('salvarClientes') }}" class="btn btn-primary btn-sm btn-round float-right"><i class="ti-arrow-up mr-1"></i>Enviar Web 2<a>
            </div>
        </div>
        <br><br>

        <!--
        <div class="row">
            <div class="card-body">
                <table id="#" class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Código Crédito</th>
                        <th>Codigo Membro</th>
                        <th>Loan Number</th>
                        <th>Nome</th>
                    </tr>
                    </thead>
                    <tbody>                       
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>-->
    </div> 
    <!-- FIm do corpo -->
</div>
<script>
    $(document).on('click','.salvarClientes',function(e){
        document.getElementById("loader").style.display = "block";
		e.preventDefault();
        $.ajax({
            url: "{{ url('salvarClientes') }}",
            type: "GET",
            success: function(data){
                document.getElementById("loader").style.display = "none";   
                location.reload();  
                alert(data);         
            },
            error: function(e)
            {
                document.getElementById("loader").style.display = "none";   
                alert('ERRO AO SALVAR');                             
            }
        });      
    });     
</script>
@stop
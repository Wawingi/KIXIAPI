@extends('layouts.inicio')
@section('content1')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Enviar Dados ao KA</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tipos Registados</a></li>
                    </ol>
                </div>
                <h4 class="page-title">LISTAR TIPOS DO KIXIPEDIDOS</h4>
            </div>
        </div>
    </div><br>
    
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
    <div style="height:40px;background:#ff8e8e" class="alert icon-custom-alert  alert-outline-danger b-round fade show" role="alert">                                            
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
    <!-- fim da validação de retornos -->

    <div id="loader" class="loader">Loading...</div>

    <!-- Inicio do corpo -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h7 style="color:#18af85a1;font-size:14px">TOTAL DE TIPOS DO KIXIAGENDA: <span style="font-weight:bold;color:#18af85a1;font-size:14px">{{$contTiposKA}}</span></h7>    
                        </div>
                        <div class="col-6">
                            <h7 class="float-right" style="color:#f5b119d4;font-size:14px">TOTAL DE TIPOS DO KIXIPEDIDOS: <span style="font-weight:bold;color:#f5b119d4;font-size:14px">{{count($tipos)}}</span></h7>    
                        </div>
                    </div><hr>
                    @if($contTiposKA!=count($tipos))
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="SalvarTipo btn btn-success float-right btn-sm btn-round"><i class="ti-arrow-up mr-2"></i>Enviar Tipos ao KA<a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
  
    <br><br><br>
 
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 style="text-align:center;color:#f5b119d4">TIPOS DO KIXIPEDIDOS</h4>
                <table id="#" class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Tipo Abreviado</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tipos as $tipo)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$tipo->acTipo}}</td>
                            <td>{{$tipo->acTipoExcel}}</td>
                            <td>{{$tipo->acTipoAbreviado}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
   
    <!-- FIm do corpo -->
</div>
<script>
    $(document).on('click','.SalvarTipo',function(e){
        
        document.getElementById("loader").style.display = "block";
		e.preventDefault();

        $.ajax({
            url: "{{ url('salvarTiponoKA') }}",
            type: "GET",
            success: function(data){
                document.getElementById("loader").style.display = "none";   
                location.reload();  
                alert('SUCESSO');         
            },
            error: function(e)
            {
                alert('ERRO AO SALVAR');                             
            }
        });   
        
    });  
</script>
@stop
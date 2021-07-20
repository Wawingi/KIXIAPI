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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Origens Registadas</a></li>
                    </ol>
                </div>
                <h4 class="page-title">LISTAR ORIGENS DO KIXIPEDIDOS</h4>
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
                            <h7 style="color:#18af85a1;font-size:14px">TOTAL DE ORIGENS DO KIXIAGENDA: <span style="font-weight:bold;color:#18af85a1;font-size:14px">{{$contOrigensKA}}</span></h7>    
                        </div>
                        <div class="col-6">
                            <h7 class="float-right" style="color:#f5b119d4;font-size:14px">TOTAL DE ORIGENS DO KIXIPEDIDOS: <span style="font-weight:bold;color:#f5b119d4;font-size:14px">{{count($origens)}}</span></h7>    
                        </div>
                    </div><hr>
                    @if($contOrigensKA!=count($origens))
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="SalvarOrigem btn btn-success float-right btn-sm btn-round"><i class="ti-arrow-up mr-2"></i>Enviar Origens ao KA<a>
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
                    <h4 style="text-align:center;color:#f5b119d4">ORIGENS DO KIXIPEDIDOS</h4>
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
                            @foreach($origens as $origem)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$origem->acOrigem}}</td>
                                <td>{{$origem->acOTitulo}}</td>
                                <td>{{$origem->acODado}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ url('registarTeste')}}"> 
        @csrf     
        <textarea name="descricao" class="form-control form-control-sm corInput"></textarea>  
        <button type="submit">OK</button>                           
    </form> 
   
    <!-- FIm do corpo -->
</div>
<script>
    $(document).on('click','.SalvarOrigem',function(e){
        
        document.getElementById("loader").style.display = "block";
		e.preventDefault();

        $.ajax({
            url: "{{ url('salvarOrigemnoKA') }}",
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
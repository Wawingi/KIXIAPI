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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Utilizadores Registados</a></li>
                    </ol>
                </div>
                <h4 class="page-title">LISTAR UTILIZARES DO KIXIPEDIDOS</h4>
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
    <br>
 
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 style="text-align:center;color:#f5b119d4">UTILIZADORE DO KIXIPEDIDOS NÃO SINCRONIZADOS</h4>
                <table id="#" class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nome</th>
                        <th>Departameno</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($usersFalta as $Utilizador)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$Utilizador->UtCodigo}}</td>
                            <td>{{$Utilizador->Nombre01.' '.$Utilizador->Nombre02.' '.$Utilizador->Nombre03}}</td>
                            <td>{{$Utilizador->departamento}}</td>
                            <td>
                                <a title="Sincronizar dados" href="#" username="{{$Utilizador->UtCodigo}}" class="sincronizar btn btn-primary btn-round btn-sm"><i class='fa fa-sync'> Sincronizar</i></a>
                            </td>
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
    $(document).on('click','.sincronizar',function(e){
        
        document.getElementById("loader").style.display = "block";
		e.preventDefault();

        var username = $(this).attr('username');

        $.ajax({
            url: "{{ url('salvarUtilizadornoKA') }}/"+username,
            type: "GET",
            success: function(data){
                document.getElementById("loader").style.display = "none";   
                location.reload(); 
                alert("Sincronizado com Sucesso.");     
            },
            error: function(e)
            {
                alert('ERRO AO SALVAR');                            
            }
        });  
    });  
</script>
@stop
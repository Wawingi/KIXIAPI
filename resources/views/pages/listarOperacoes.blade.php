@extends('layouts.inicio')
@section('content1')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Receber Dados do KA</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Operações Registadas</a></li>
                    </ol>
                </div>
                <h4 class="page-title">ACÇÕES DE HOJE</h4>
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

    <!-- Inicio do corpo -->
    <div class="card">
        <div class="row">
            <div class="col-lg-6"><br>
                <h7 style="font-weight:bold;color:#18af85a1;font-size:16px">TOTAL DE ACÇÕES DO KIXIAGENDA WEB: {{count($operacoes)}}</h7>
            </div>
            @if(count($operacoes)>0)
                <div class="col-lg-6"><br>
                    <a href="{{ url('salvarAccao')}}" class="btn btn-success btn-sm btn-round float-right">Salvar Local<a>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="card-body">
            <table id="#" class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Responsável</th>
                        <th>Estado</th>
                        <th>Avanço</th>
                        <th>Data</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($operacoes as $op)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$op->utilizador_codigo}}</td>
                            <td>{{$op->estado}}</td>
                            <td>{{$op->avanco}}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($op->updated_at)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- FIm do corpo -->
</div>
<script>
    $(document).ready( function () {
        $('#dataTableFuncionario').DataTable({
            "pagingType": "full_numbers"
        });
    } );
</script>
@stop
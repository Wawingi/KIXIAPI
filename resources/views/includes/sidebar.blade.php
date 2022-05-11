<!-- Left Sidenav -->
<div class="left-sidenav">
    <ul class="metismenu left-sidenav-menu">
        <li>
            <a href="javascript: void(0);"><i class="ti-arrow-down"></i><span>Receber Dados do KA</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item"><a class="nav-link" href="{{ url('pegaTarefas') }}"><i class="ti-control-record"></i>Actividades Registadas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('pegaOperacoes') }}"><i class="ti-control-record"></i>Accões Registadas</a></li>
            </ul>
        </li>
    
        <li>
            <a href="javascript: void(0);"><i class="ti-arrow-up"></i><span>Enviar Dados ao KA</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item"><a class="nav-link" href="{{ url('listarUtilizadores') }}"><i class="ti-control-record"></i>Utilizadores do KP</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('listarTipos') }}"><i class="ti-control-record"></i>Tipos do KP</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('listarOrigens') }}"><i class="ti-control-record"></i>Origens do KP</a></li>
            </ul>
        </li>
        
        <li>
            <a href="javascript: void(0);"><i class="ti-arrow-up"></i><span>Enviar ao KixiClientes</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item"><a class="nav-link" href="{{ url('listarClientes') }}"><i class="ti-control-record"></i>Enviar Clientes</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- end left-sidenav-->

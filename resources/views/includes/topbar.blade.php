<!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ ('dashboard') }}" class="logo">
            <span>
                <img src="{{ asset('images/logo.jpg') }}" width="70px" heigth="70px">
            </span>
            <span style="color: #52b4da; font-size:25px">
                KIXI API
            </span>
        </a>
    </div>
    <!--end logo-->

    <!-- Navbar -->
    <nav class="navbar-custom Cabecalho">    
        <ul class="list-unstyled topbar-nav float-right mb-0"> 

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('images/users/user.jpg') }}" alt="profile-user" class="rounded-circle" /> 
                    <span class="ml-1 nav-user-name hidden-sm">Administrador<i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> Perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('logout') }}"><i class="ti-power-off text-muted mr-2"></i> Sair</a>
                </div>
            </li>
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">                        
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="ti-menu nav-icon"></i>
                </button>
            </li>
            <!--<li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="Pesquisar..." class="form-control">
                    <a href="#"><i class="ti-search"></i></a>
                </form>
            </li>-->
        </ul>
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->
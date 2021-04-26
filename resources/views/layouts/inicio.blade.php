@extends('layouts.app')
@section('content')

 <!-- TopBar-->
 @include('includes.topbar')

<div class="page-wrapper">
    <!-- SIDE MENU BAR-->
    @include('includes.sidebar')

    <!-- Page Content-->
    <div class="page-content">
        <!-- Inicio da Content depois de logado -->
            @yield('content1')
        <!-- Fim da Content depois de logado -->

        <!-- TopBar-->
        @include('includes.footer')
    </div>
    <!-- end page content -->
</div>
@stop
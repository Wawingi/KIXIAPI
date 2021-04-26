@extends('layouts.app')
@section('content')
<!-- Log In page -->
<div class="row vh-100 ">
    <div class="col-12 align-self-center">
        <div class="auth-page"><br><br>
            <div class="card auth-card shadow-lg">
                <div class="card-body">
                    <div class="px-3">       
                        <div class="text-center auth-logo-text">
                            <h4 style="color: #28a745" class="mt-0 mb-3 mt-5">KIXI API</h4>
                            <hr> 
                        </div>
                        <?php //dd(App\Model\Tipo::all()); ?>
                        <!-- Alerta de erro ao logar -->
                        @if(session('error'))
                            <br>
                            <div style="height:40px" class="alert icon-custom-alert  alert-outline-pink b-round fade show" role="alert">                                            
                                <div class="alert-text">
                                    {{ session('error')}}
                                </div>
                                
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="mdi mdi-close text-danger"></i></span>
                                    </button>
                                </div>
                            </div>  
                        @endif
                                               
                        <form id="ValidarFormLogin" method="post" class="form-horizontal auth-form my-4" action="{{ url('logar') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <span class="auth-form-icon">
                                        <i class="dripicons-user"></i> 
                                    </span>                                                                                                              
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Informe username">
                                </div>                                    
                            </div><!--end form-group--> 

                            <div class="form-group">                 
                                <div class="input-group mb-3"> 
                                    <span class="auth-form-icon">
                                        <i class="dripicons-lock"></i> 
                                    </span>                                                       
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Informe password">
                                </div>                               
                            </div><!--end form-group--> 

                            <div class="form-group row mt-4">
                                <div class="col-sm-6 text-right">
                                    <a href="{{ url('dashboard') }}" class="text-muted font-13"><i class="dripicons-lock"></i> Esqueceu a sua senha ?</a>                                    
                                </div><!--end col--> 
                            </div><!--end form-group--> 

                            <div class="form-group mb-0 row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                </div><!--end col--> 
                            </div> <!--end form-group-->                           
                        </form><!--end form-->
                    </div><!--end /div-->
                    
                </div><!--end card-body-->
            </div><!--end card-->
            
        </div><!--end auth-page-->
    </div><!--end col-->           
</div><!--end row-->     
<script>
    // Validação do formulário do funcionário
    $("#ValidarFormLogin").validate({
		rules: {					
			username: {
				required: true,
                pattern: /^[a-z]{14}+$/
			},
			password: {
				required: true 
			}       
		},
		messages: {					
			username: {
                required: "O nome do utilizador deve ser fornecido.",
                pattern: "O padrão do username é inválido.",
			},
            password: {
				required: "O email deve ser fornecido"
			}
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
		}
    });    
</script>
@endsection

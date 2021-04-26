<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div id="cabeca-modall" class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle"><i class="mdi mdi-plus-circle mr-1"></i>Registar Funcionário</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background:#fff" class="modal-body">
                <form id="ValidarForm" method="post" action="{{ url('registarFuncionario') }}">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="genero">Genero</label><br>
                                <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                    <input type="radio" id="genero" value="1" name="genero" checked>
                                    <label for="inlineRadio1"> Masculino </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" id="genero" value="2" name="genero">
                                    <label for="inlineRadio2"> Feminino </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="number" class="form-control" id="telefone" name="telefone" placeholder="Informe o número de telefone">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Informe o email">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="ex.: eunice.gastao">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="funcao">Tipo de documento</label>
                                <select id="tipo_documento" name="tipo_documento" class="custom-select">
                                    <option value="1">B.I</option>
                                    <option value="2">Passaporte</option>
                                    <option value="3">Outro</option>
                                </select>         
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="numero doc">Número Documento</label>
                                <input type="text" class="form-control form-control-sm" id="numero_documento" name="numero_documento" placeholder="Informe o nº de documento">
                            </div>
                        </div>
                        <!--Buscar area de aplicação na BD e preencher a combobox -->
                        <?php $departamentos = App\Model\Departamento::all();?>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <select id="departamento" id="departamento" name="departamento" class="custom-select">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                    </div>                   
                   
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
// Validação do formulário do funcionário
    $("#ValidarForm").validate({
		rules: {					
			nome: {
				required: true,
                pattern: /^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/
			},
			genero: {
				required: true,
                minlength:1,   
                minlength:1   
			},
            telefone: {
				required: true,
                minlength:9,   
                maxlength:9   
			},
            email: {
				required: true
			},
            username: {
				required: true,
                pattern: /^[a-z]+[.]{1}[a-z]+$/
			},
			numero_documento: {
				required: true,              
				minlength:1               
			}            
		},
		messages: {					
			nome: {
                required: "O nome deve ser fornecido.",
                pattern: "Informe um nome válido contendo apenas letras alfabéticas"
			},
            genero: {
				required: "O género deve ser fornecido",
                minlength:"O tamanho fornecido é inferior",   
                minlength:"O tamanho fornecido é superior"   
			},			  
            telefone: {
				required: "O número do telefone deve ser fornecido",
                minlength:"O tamanho fornecido é inferior",   
                maxlength:"O tamanho fornecido é superior"   
			},
            email: {
				required: "O email deve ser fornecido"
			},
            username: {
				required: "O username deve ser fornecido",
                pattern: "O padrão do username é inválido.",
			},
			numero_documento: {
				required: "O número do documento deve ser fornecido",              
				minlength: "Informe um tamanho válido"              
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

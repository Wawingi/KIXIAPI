<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div style="height:50px" id="cabeca-modall" class="modal-header">
                <h4 style="margin-top:1px"  class="modal-title" id="exampleModalScrollableTitle"><i class="mdi mdi-clipboard-account-outline mr-1"></i>Atender Visitante</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background:#fff" class="modal-body">
                <form id="ValidarForm" method="post" action="{{ url('registarAtendimento') }}">
                    @csrf
                    <div class="row">
                        <input type="hidden" class="form-control inputShow" name="id_marcacao" value="{{$marcacao->id_marcacao}}">
                        <!--Buscar area de aplicação na BD e preencher a combobox -->
                        <?php $departamentos = App\Model\Departamento::all();?>
                        <div class="col-7">
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <select id="departamento" id="departamento" name="departamento" class="custom-select">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="funcao">Estado</label>
                                <select id="estado" name="estado" class="custom-select">
                                    <option value="1">Encaminhar ao Departamento</option>
                                    <option value="2">Atendido</option>
                                    <option value="3">Agendar</option>
                                </select>         
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Assunto</label>
                                <textarea id="assunto" name="assunto" type="text" class="form-control"></textarea>
                            </div>
                        </div>                            
                    </div>

                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Atender</button>
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
			departamento: {
				required: true              
			},
			estado: {
				required: true
			},
            assunto: {
                required: true  
			}         
		},
		messages: {					
			departamento: {
                required: "O departamento deve ser fornecido."
			},
            estado: {
				required: "O estado deve ser fornecido" 
			},			  
            assunto: {
                required: "O assunto deve ser fornecido"   
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

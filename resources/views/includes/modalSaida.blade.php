<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div style="height:50px" id="cabeca-modall" class="modal-header">
                <h4 style="margin-top:1px" class="modal-title" id="exampleModalScrollableTitle"><i class="mdi mdi-store mr-1"></i>Registar Saída do Produto</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background:#fff" class="modal-body">
                <form id="ValidarFormProduto" method="post" action="{{ url('registarSaida') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" value="{{$produto->id}}" id="id_produto" name="id_produto">
                            </div>
                        </div>           
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Responsavel da Entrega</label>
                                <input type="text" class="form-control" id="entrega" name="entrega" placeholder="ex.: Mateus Mbiavanga">
                            </div>
                        </div>  
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Destino</label>
                                <input type="text" class="form-control" id="recebedor" name="recebedor" placeholder="ex.: CAP-123">
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Quantidade</label>
                                <input type="number" min="1" class="form-control" id="quantidade" name="quantidade" placeholder="Informe a quantida a entregar">
                            </div>
                        </div>  
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Data de Entrega</label>
                                <input type="date" class="form-control form-control-sm" id="data_entrega" name="data_entrega">
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
    $("#ValidarFormProduto").validate({
		rules: {					
			entrega: {
				required: true              
			},
			recebedor: {
				required: true
			},
            quantidade: {
                required: true,
			},         
            data_entrega: {
                required: true  
			},         
		},
		messages: {					
			entrega: {
                required: "O valor deve ser fornecido."
			},
            recebedor: {
				required: "O valor deve ser fornecido." 
			},			  
            quantidade: {
                required: "O valor deve ser fornecido."   
			},   
            data_entrega: {
                required: "O valor deve ser fornecido."   
			},   
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

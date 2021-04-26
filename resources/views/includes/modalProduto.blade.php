<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div style="height:50px" id="cabeca-modall" class="modal-header">
                <h4 style="margin-top:1px" class="modal-title" id="exampleModalScrollableTitle"><i class="mdi mdi-store mr-1"></i>Registar Produto</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background:#fff" class="modal-body">
                <form id="ValidarFormProduto" method="post" action="{{ url('registarProduto') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Designação</label>
                                <input type="text" class="form-control" id="designacao" name="designacao" placeholder="Informe o produto">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="funcao">Categoria</label>
                                <select id="categoria" name="categoria" class="custom-select">
                                    <option>Material Publicitário</option>
                                    <option>Material para Carros</option>
                                    <option>Material do Escritório</option>
                                    <option>Consumíveis</option>
                                </select>         
                            </div>
                        </div>           
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="name">Quantidade</label>
                                <input min="1" type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Informe a quantidade">
                            </div>
                        </div>  
                        <div class="col-4">
                            <div class="form-group">
                                <label for="email">Data de Entrada</label>
                                <input type="date" class="form-control form-control-sm" id="data_entrada" name="data_entrada">
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
			designacao: {
				required: true              
			},
			categoria: {
				required: true
			},
            quantidade: {
                required: true,
			},         
            data_entrada: {
                required: true  
			},         
		},
		messages: {					
			designacao: {
                required: "A designacao deve ser fornecida."
			},
            categoria: {
				required: "A categoria deve ser fornecida" 
			},			  
            quantidade: {
                required: "A quantidade deve ser fornecida"   
			},   
            data_entrada: {
                required: "A data deve ser fornecida"   
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

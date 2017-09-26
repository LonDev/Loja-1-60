@extends('app')
@section('content')
<link rel="stylesheet" type="text/css" href="<% asset('datepicker/css/datepicker.css') %>">
<script src="<% asset('js/notaController.js') %>"></script>
<script src="<% asset('datepicker/js/bootstrap-datepicker.js') %>"></script>
<script type="text/javascript">
            $(function () {
                $('#vencimento').datepicker({
                   format: 'dd/mm/yyyy'
                });
            });
</script>
<div class="container"  ng-app="nota_modulo" ng-controller="nota_controller">

<h3>Cadastrar notas</h3>
	
	<table class="table table-condensed">
			<tr>
				<td colspan="3">
				&nbsp;
				</td>
				<td>
					<button class="btn btn-sm btn-success" id="salvar">Salvar</button>
					@if(@$fornecedor->id > 0)
						<button class="btn btn-sm btn-danger" ng-click="delete_p(produto.id)">Apagar</button>
					@endif
				</td>
			</tr>
	</table>
	<form>
		<input type="hidden" name="_token" value="<% csrf_token() %>">
		<input type="hidden" name="id" value="<% @$nota->id %>">
		<input type="hidden" name="itens" id="itens" value="<% @$nota->itens %>">
		<table class="table table-condensed">
			<tr>
				<td>
					<label>Nº da nota:</label>
				</td>
				<td>
					<label>Vencimento:</label>
				</td>
				<td>
					<label>Total da nota:</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" id="numero_nota" name="numero_nota" value="<% @$nota->numero_nota %>">
				</td>
				<td>
					<input type="text" id="vencimento" name="vencimento" readonly value="<% @$nota->vencimento %>">
				</td>
				<td>
					<input type="number" step="0.01" name="total_nota" value="<% @$nota->total_nota %>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Tipo de nota:</label>
				</td>
				<td colspan="2">
					<label>Fornecedor(Empresa): *</label>
				</td>
				<td>
					<label>CNPJ do fornecedor</label>
				</td>
			</tr>
			<tr>
				<td>
					<select name="tipo_nota" class="form-control">
					<option value="1">Compra</option>					
					</select>
				</td>
				<td colspan="2">
					<select name="id_fornecedor" id="fornecedor" class="form-control">
						@foreach($fornecedores as $fornecedor)
						<option value="<% $fornecedor->id %>"
						@if(@$nota->id_fornecedor == $fornecedor->id)
							selected
						@endif><% $fornecedor->nome %></option>
						@endforeach
					</select>
				</td>
				<td>
					<input type="text" name="cnpj" class="form-control" value="{{ fornecedor.cnpj }}" readonly>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Endereço:</label></td>
				<td>
					<label>Bairro:</label></td>
				<td>
					<label>CEP:</label></td>

			</tr>
			<tr>
				<td colspan="2">
					<input type="text" name="endereco" class="form-control" value="{{ fornecedor.endereco }}">
				</td>			
				<td colspan="">
					<input type="text" name="bairro" class="form-control" value="{{ fornecedor.bairro }}">
				</td>
				<td>
					<input type="text" name="cep" class="form-control" value="{{ fornecedor.cep }}">
				</td>
			</tr>
			<tr>
				<td>
					<label>Cidade:</label></td>
				<td>
					<label>UF:</label></td>
				<td>
					<label>Telefone:</label></td>
				<td>
					<label>Incrição estadual:</label></td>
			</tr>
			<tr>
				<td colspan="">
					<input type="text" name="cidade" class="form-control" value="{{ fornecedor.cidade }}"></td>
				<td>
					<input type="text" name="estado" size="2" value="{{ fornecedor.estado }}"></td>
				<td>
					<input type="text" name="telefone_1" value="{{ fornecedor.telefone_1 }}"></td>
				<td>
					<input type="text" name="incricao_estado" value="{{ fornecedor.incricao_estado }}"></td>
			</tr>
			</table>
			<table class="table table-condensed" id="table-descricao">
			<tr>
				<td colspan="1">
					<input type="tex" name="produto" id="produto" placeholder="nome ou inicial do produto..." class="form-control">
				</td>
				<td>
					<button id="busca" class="btn btn-sm btn-primary">buscar</button>
				</td>
			<tr>
				<td>
					<label>Descrição</label>
				</td>
				<td>
					<label>Quantidade</label>
				</td>
				<td>
					<label>Unitário</label>
				</td>
				<td>
					<label>Total</label>
				</td>
			</tr>
			
		</table>
	</form>

<!-- Modal novo local-->
	<div class="modal fade" id="ModalBusca">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title">Buscar por nome</h4>
	      </div>
	      <div class="modal-body">
	      	
	      	<table class="table table-condensed table-hover">
	      		<tr>
	      			<td>Descrição</td>
	      			<td>Preço V.</td>
	      			<td>Preço A.</td>
	      			<td>Qtde. Disponivel</td>
	      		</tr>
	      		<tr ng-repeat="descItem in lista" ng-click="select( descItem )" data-dismiss="modal">
	      			<td>{{ descItem.DESCRICAO }}</td>
	      			<td>{{ descItem.PRECO }}</td>
	      			<td>{{ descItem.PRECOATACADO }}</td>
	      			<td>{{ descItem.QTD_ATUAL }}</td>
	      		</tr>
	      	</table>
		    	
	      </div><!--/modal body-->
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


</div>

@endsection
@extends('app')
@section('content')
<div class="container"  ng-app="modulo_fornecedor" ng-controller="fornecedor_controller">
<h3>Cadastrar Fornecedor</h3>
	
	<table class="table table-condensed">
			<tr>
				<td colspan="3">
					* campos obirgatórios
				</td>
				<td>
					<button class="btn btn-sm btn-success" id="salvar">Salvar</button>
					@if(@$fornecedor->id > 0)
						<button class="btn btn-sm btn-danger" ng-click="delete_p(produto.id)">Apagar</button>
					@endif
				</td>
			</tr>
	</table>
	<form action="<% url('fornecedor/salvar') %>" method="post">
		<input type="hidden" name="_token" value="<% csrf_token() %>">
		<input type="hidden" name="id" value="<% @$fornecedor->id %>">
		<table class="table table-condensed">
			<tr>
				<td colspan="4">
					<label>Fornecedor(Empresa): *</label></td>
			</tr>
			<tr>
				<td colspan="4">
					<input type="text" name="nome" class="form-control" required value="<% @$fornecedor->nome %>"></td>
			</tr>
			<tr>
				<td colspan="3">
					<label>Endereço:</label></td>
				<td>
					<label>Numero:</label></td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="text" name="endereco" class="form-control" value="<% @$fornecedor->endereco %>"></td>
				<td>
					<input type="text" name="numero" value="<% @$fornecedor->numero %>"></td>
			</tr>			
			<tr>
				<td colspan="3">
					<label>Bairro:</label></td>
				<td>
					<label>CEP:</label></td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="text" name="bairro" class="form-control" value="<% @$fornecedor->bairro %>"></td>
				<td>
					<input type="text" name="cep" placeholder="Ex.: 08780-000" class="form-control" value="<% @$fornecedor->cep %>"></td>
			</tr>
			<tr>
				<td>
					<label>Cidade:</label></td>
				<td>
					<label>Estado:</label></td>
				<td>
					<label>CNPJ:</label></td>
				<td>
					<label>Incrição estadual:</label></td>
			</tr>
			<tr>
				<td>
					<input type="text" name="cidade" class="form-control" value="<% @$fornecedor->cidade %>"></td>
				<td>
					<input type="text" name="estado" size="2" value="<% @$fornecedor->estado %>"></td>
				<td>
					<input type="number" name="cnpj" value="<% @$fornecedor->cnpj %>"></td>
				<td>
					<input type="number" name="incricao_estado" value="<% @$fornecedor->incricao_estado %>"></td>
			</tr>
			<tr>
				<td>
					<label>Telefone 1: *</label></td>
				<td>
					<label>Telefone 2:</label></td>
				<td>
					<label>E-mail:</label></td>
				<td>
					<label>Telefone do representante:</label></td>
			</tr>
			<tr>
				<td>
					<input type="text" name="telefone_1" required value="<% @$fornecedor->telefone_1 %>"></td>
				<td>
					<input type="text" name="telefone_2" value="<% @$fornecedor->telefone_2 %>"></td>
				<td>
					<input type="text" name="email" value="<% @$fornecedor->email %>"></td>
				<td>
					<input type="text" name="telefone_representante" value="<% @$fornecedor->telefone_representante %>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Representante:</label></td>
				<td>
					<label>Celular:</label></td>
				<td>
					<label>Operadora:</label></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="text" name="representante" required class="form-control" value="<% @$fornecedor->representante %>"></td>
				<td>
					<input type="text" name="celular" required value="<% @$fornecedor->celular %>"></td>
				<td>
					<select name="operadora">
						<option value="">Selecione</option>
						@foreach($MEDIDAS as $medida)
						<option value="<% $medida->operadoras %>"
							@if(@$fornecedor->operadora == $medida->operadoras)
								selected
							@endif><% $medida->operadoras %></option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Email do representante:</label></td>
				<td colspan="2">
					<label>Site da empresa:</label></td>
				<td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="text" name="email_representante" class="form-control" value="<% @$fornecedor->email_representante %>"></td>
				<td colspan="2">
					<input type="text" name="site" class="form-control" value="<% @$fornecedor->site %>"></td>
			</tr>
			<tr>
				<td>
					<label>Limite de crédito:</label></td>
				<td>
					<label>Prazo(dias):</label></td>
				<td colspan="2">
					<label>Forma de entrega:</label></td
			</tr>
			<tr>
				<td>
					<input type="number" step="0.1" name="limite" value="<% @$fornecedor->limite %>"></td>
				<td>
					<input type="number" name="prazo" value="<% @$fornecedor->prazo %>"></td>
				<td colspan="2">
					<select name="forma_entrega">
						<option>Selecione</option>
						@foreach($MEDIDAS as $medida)
						<option value="<% $medida->forma_entrega %>"
							@if(@$fornecedor->forma_entrega == $medida->forma_entrega)
								selected
							@endif><% $medida->forma_entrega %></option>
						@endforeach
					</select>
				</td>
			</tr>
		</table>
	</form>
</div>
<script src="<% asset('js/fornecedorController.js') %>"></script>

@endsection
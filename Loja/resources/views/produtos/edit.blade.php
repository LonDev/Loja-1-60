@extends('app')
@section('content')
<div class="container"  ng-app="modulo_produto" ng-controller="produto_controller">
<h3>Novo Produto</h3>
	
	@if($errors->any())
		<ul class="alert alert-warning">
			@foreach($errors->all() as $error)
				<li><% $error %></li>
			@endforeach
		</ul>
	@endif
	<form action="<% route('produtos.update',$produto->id) %>" method="post">
		<input type="hidden" name="_token" value="<% csrf_token() %>">

		<!-- carrega fornecedor, localizacao,setor-->
		<input hidden ng-model="fornece='<% $produto->fornecedor_id %>'"/>
		<input hidden ng-model="local_1='<% $produto->localizacao_id %>'"/>
		<input hidden ng-model="setor_1='<% $produto->setor_id %>'"/>
		<!-- -->

		<table class="table table-responsive">
			<tr>
				<td>
					<label>Cod:</label>
				</td>
				<td>
					<label>Descrição do produto:</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="id" readonly size="2" value="<% $produto->id %>">
				</td>
				<td>
					<input type="text" name="descricao" placeholder="EX.: bala de goma" class="form-control" value="<% $produto->descricao %>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Unidade:</label>
				</td>
				<td>
					<label>Fornecedor:</label>
				</td>
			</tr>

			<tr>
				<td>
					<select name="unidade">
						<option value="<% $produto->unidade %>" selected>
							<% $produto->unidade %>
						</option>
						<option value="UN">UN</option>
						<option value="CM">CM</option>
						<option value="ML">ML</option>
						<option value="KG">KG</option>
						<option value="LT">LT</option>
						<option value="GR">GR</option>
						<option value="MM">MM</option>
						<option value="MG">MG</option>
						<option value="PC">PC</option>
					</select>
				</td>
				<td>
					<select name="fornecedor_id" class="form-control">
						<option>Selecione um Fornecedor</option>
						<option ng-repeat="fornecedor in fornecedores" value="{{fornecedor.id}}" ng-if="fornece == fornecedor.id" selected>
						{{ fornecedor.nome }}</option>
						<option ng-repeat="fornecedor in fornecedores" value="{{fornecedor.id}}">
						{{ fornecedor.nome }}</option>
			
					</select>
				</td>
			</tr>
			
			<tr>
				<td>
					<label>Localização do produto:</label>
				</td>
				<td>
					<label>Referencia/Observação:</label>
				</td>
			</tr>
			<tr>
				<td>
					<select name="localizacao_id" class="form-control">
						<option>Selecione uma localização</option>
						<option ng-repeat="local in localizacao" value="{{local.id}}" ng-if="local_1 == local.id" selected>
						{{ local.nome }}</option>
						<option ng-repeat="local in localizacao" value="{{local.id}}">
						{{ local.nome }}</option>
					</select>
				</td>
				<td>
					<input type="text" name="referencia"  placeholder="Ex.: corredor dos fundos" class="form-control" value="<% $produto->referencia %>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Código de Barras:</label>
				</td>
				<td>
					<label>Setor:</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="codigo_de_barras" class="form-control" value="<% $produto->codigo_de_barras %>">
				</td>
				<td>
					<select name="setor_id" class="form-control">
						<option>Selecione um Setor</option>
						<option ng-repeat="setors in setor" value="{{setors.id}}" ng-if="setor_1 == setors.id" selected>
						{{ setors.nome }}</option>
						<option ng-repeat="setors in setor" value="{{setors.id}}">
						{{ setors.nome }}</option>
					</select>
				</td>
			</tr>
		</table>
	
		<table class="table table-responsive">
			<tr>
				<td><label>Quantidade estoque:</label></td>
				<td><label>Estoque critico:</label></td>
				<td><label>Cadastrado em:</label></td>
				<td><label>Atualizado em:</label></td>
				<td><label>Situação</label></td>
			</tr>
			<tr>
				<td><input type="number" name="quantidade" value="<% $produto->quantidade %>"></td>
				<td><input type="number" name="quantidade_critico" value="<% $produto->quantidade_critico %>"></td>
				<td><input type="text" name="created_at" readonly value="<% $produto->created_at %>"></td>
				<td><input type="text" name="updated_at" readonly value="<% $produto->updated_at %>"></td>
				<td><select name="situacao">
						<option>Selecione</option>
						<option value="disponivel">Disponivel</option>
						<option value="indisponivel">Indisponivel</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Preço de Custo:</label></td>
				<td><label>Margem de Lucro:</label></td>
				<td><label>Preço de Venda:</label></td>
				<td><label>Preço Atacado:</label></td>
				<td><label>Lucro do varejo:</label></td>
			</tr>
			<tr>
				<td><input type="number" step="0.1" name="preco_custo"
				value="<% $produto->preco_custo %>"></td>
				<td><input type="number" step="0.1" name="margem_lucro" 
				value="<% $produto->margem_lucro %>"></td>
				<td><input type="number" step="0.1" name="preco_venda" 
				value="<% $produto->preco_venda %>"></td>
				<td><input type="number" step="0.1" name="preco_atacado" value="<% $produto->preco_atacado %>"></td>
				<td><input type="number" step="0.1" name="lucro_varejo" value="<% $produto->lucro_varejo %>"></td>
			</tr>
		</table>
	<button class="btn btn-success">Salvar</button>
	</form>
</div>
<script src="<% asset('js/angular.min.js') %>"></script>
<script src="<% asset('js/produtosController.js') %>"></script>

@endsection
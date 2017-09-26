@extends('app')
@section('content')
<script src="<% asset('js/lista_produto.js') %>"></script>

<div class="container" ng-app="lista_modulo" ng-controller="lista_produto_controller">

<div style="float:left"><h3>Lista de Produtos</h3>
	<div ng-show="!listaVazia()">
		Mostrando {{ from +' - '+ to}}
		<br>
		Página atual:
		<button class="btn btn-sm btn-default" ng-click="next(prev_page)" title="Pagina anterior" ng-if="prev_page != null ">
		<span class="glyphicon glyphicon-chevron-left"></span>
		</button>
		{{ current_page }}
		<button class="btn btn-sm btn-default" ng-click="next(next_page)" title="Proxima pagina" ng-if="next_page != null ">
		<span class="glyphicon glyphicon-chevron-right"></span>
		</button>
	</div>

</div>
 <div style="float:right" ng-show="!listaVazia()">
 	<br>
 	<input type="text" ng-model="busca" placeholder="Busca rapida">
 	<br>
 	Qtd de itens em estoque: {{total_stock }}<br>
 	Valor total(custo): R$ {{ total_custo }}<br>
 	Valor total(preço de venda): R$ {{ total_venda }}<br>
 	
 </div>

<table class="table table-hover table-striped table-condensed" ng-show="!listaVazia()">
	<tr>
		<th>Cod. Barras</th>
		<th>Un</th>
		<th>Descrição</th>
		<th>Quantidade</th>
		<th>Preço</th>
		<th>Situação</th>
		<th>Ult atulização</th>
		<th>Ação</th>
	</tr>
	<tr ng-repeat="produto in lista | filter:busca">
		<td>{{ produto.REFERENCIA }}</td>
		<td>{{ produto.MEDIDA }}</td>
		<td>{{ produto.DESCRICAO }}</td>
		<td>{{ produto.QTD_ATUAL }}</td>
		<td>{{ produto.PRECO }}</td>
		<td>{{ situacao(produto.ATIVO) }}</td>
		<td>{{ produto.data }}</td>
		<td>
			<a href="/produtos/{{ produto.ID }}/edit" class="btn btn-sm btn-primary">editar</a>
			<button ng-click="delete_p(produto.ID)" class="btn btn-sm btn-danger">apagar</button>
		</td>
	</tr>
</table>
<!-- caso a lista esteja vazia -->
<div class="carregando col-md-12">
	<center>
	<img src="<% asset('img/loading.gif') %>"><br>
	Carregando...
	</center>
</div>

</div>
@endsection
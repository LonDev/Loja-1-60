@extends('app')
@section('content')
<script src="<% asset('js/lista_fornecedor.js') %>"></script>

<div class="container" ng-app="lista_modulo" ng-controller="lista_fornecedor_controller">

<div style="float:left"><h3>Lista de Fornecedores</h3></div>

 <div  style="float:right" ng-show="!listaVazia()">
 	<br>
 	<input type="text" ng-model="busca" placeholder="Busca rapida">
 </div>

<table class="table table-hover table-striped table-condensed" ng-show="!listaVazia()">
	<tr>
		<th>Nome</th>
		<th>Ação</th>
	</tr>
	<tr ng-repeat="fornecedor in lista | filter:busca">
		<td>{{ fornecedor.nome }}</td>
		<td>
			<a href="/fornecedor/{{ fornecedor.id }}/edit" class="btn btn-sm btn-primary">editar</a>
			<button ng-click="delete_f(fornecedor.id)" class="btn btn-sm btn-danger">apagar</button>
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
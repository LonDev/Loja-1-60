@extends('app')
@section('content')
<div class="container"  ng-app="modulo_produto" ng-controller="produto_controller">
<h3>Cadastrar Fornecedor</h3>
	
	@if($errors->any())
		<ul class="alert alert-warning">
			@foreach($errors->all() as $error)
				<li><% $error %></li>
			@endforeach
		</ul>
	@endif
	<form action="<% url('localizacao/salvar') %>" method="post">
		<input type="hidden" name="_token" value="<% csrf_token() %>">
		<table class="table table-condensed">
			<tr>
				<td>
					<label>Cod:</label></td>
				<td>
					<label>Localização:</label></td>
			</tr>
			<tr>
				<td>
					<input type="text" name="id" readonly size="2"></td>
				<td colspan="3">
					<input type="text" name="nome" class="form-control"></td>
			</tr>
		</table>
	</form>
</div>
@endsection
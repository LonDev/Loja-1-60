@extends('app')
@section('content')
<div class="container">
	<h3>Painel de Controle</h3>
	<form  method="post" action="<% url('control/salvar') %>" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="<% csrf_token() %>">
		<input type="hidden" name="id" value="<% @$config->id %>">
	<table class="table table-condensed">
		<tr>
			<td colspan=""></td>
			<td align="right"><button class="btn btn-success">Salvar</button></td>
		</tr>
		<tr>
			<td><label>Tamanho da paginação</label></td>
			<td>
				<select name="paginacao">
				@foreach($MEDIDAS as $medida)
					<option value="<% $medida->paginacao %>"
					@if(@$config->paginacao == $medida->paginacao)
					selected
					@endif><% $medida->paginacao %></option>
				@endforeach
				</select>
			</td>
		</tr>
		<tr>
			<td><label>Descricao da Nota fiscal</label></td>
			<td>
				<textarea name="descricao_nota" cols="100" rows="10"><% @$config->descricao_nota %></textarea>
			</td>
		</tr>

	</form>
</div>
@endsection
@extends('app')
@section('content')
<div class="container">
<br>
	<div class="dashboard">
	
		<div class="dash-item">
			<a href="" onclick="abrir()">
				<img src="<% asset('img/vendas.png')%>">
				<br>
				Vender
			</a>
		</div>

		@if(Auth::user()->nivel_acesso == 'administrador')
		<div class="dash-item">
			<li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				<img src="<% asset('img/estoque.png')%>">
				<br>
				Estoque
				<span class="caret"></span></a>
				
				<ul class="dropdown-menu" role="menu">
					<li class="dropdown-header">Produtos</li>
					<li><a href="<% url('/produtos') %>">Lista de Produtos</a></li>
					<li><a href="<% url('/produtos/novoproduto') %>">Novo produto</a>
					
					<li class="divider" role="separator">

					<li class="dropdown-header">Forncedores</li>
					<li><a href="<% url('/fornecedor') %>">Lista de Fornecedor</a></li>
					<li><a href="<% url('/fornecedor/novofornecedor') %>">Novo Fornecedor</a></li>
				</ul>
			</li>
		</div>

		<div class="dash-item">
			<a href="<% url('/clientes') %>">
				<img src="<% asset('img/usuario.png')%>">
				<br>
				Clientes
			</a>
		</div>

		<div class="dash-item">
			<a href="<% url('/funcionarios') %>">
				<img src="<% asset('img/group.png')%>">
				<br>
				Funcionarios
			</a>
		</div>

		<div class="dash-item">
			<li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				<img src="<% asset('img/financeiro.png')%>">
				<br>
				Financeiro
				<span class="caret"></span></a>
				
				<ul class="dropdown-menu" role="menu">
					<li><a href="<% url('venda/financeiro') %>">Lista de vendas</a></li>
					<li><a href="<% url('venda/financeiro/contas') %>">Contas a pagar</a></li>
					<li><a href="<% url('venda/financeiro/notas') %>">Cadastro de notas</a></li>
				</ul>
			</li>
		</div>

		@endif
	</div><!--dashboard-->
</div>
<script type="text/javascript">
	function abrir(){
		window.open('/venda/','Vendas','fullscreen=yes');
	}
</script>
@endsection
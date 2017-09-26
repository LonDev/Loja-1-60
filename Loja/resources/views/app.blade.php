<!DOCTYPE html>
<head> 
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<% url('favicon.ico') %>" type="image/x-icon" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menina sapeca</title> 
	
	<link href="<% url('css/bootstrap.min.css') %>" rel="stylesheet">
	<link href="<% url('css/estilo.css') %>" rel="stylesheet">
	
	<script type="text/javascript" src="<% url('js/jquery-1.11.3.min.js') %>"></script>
	<script type="text/javascript" src="<% url('js/bootstrap.min.js') %>"></script>
	<script src="<% url('js/angular.min.js') %>"></script>
	
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span></button>
			<a class="navbar-brand" href="<% url('/') %>">Menina Sapeca</a>
		</div> 
		
		@if(!Auth::guest())
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			@if(Auth::user()->nivel_acesso == 'administrador')
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
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

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					Financeiro
					<span class="caret"></span></a>
					
					<ul class="dropdown-menu" role="menu">
						<li><a href="<% url('venda/financeiro') %>">Lista de vendas</a></li>
						<li><a href="<% url('venda/financeiro/contas') %>">Contas a pagar</a></li>
						<li><a href="<% url('venda/financeiro/notas') %>">Cadastro de notas</a></li>
					</ul>
				</li>
			
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					Funcionários
					<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu"> 
						<li><a href="<% url('/funcionarios') %>">Lista de Funcionários</a></li>
					</ul>
				</li>

				<li><a href="<% url('/control') %>">Painel de controle</a></li>
			</ul>
			@endif

			<ul class="nav navbar-nav navbar-right"> 
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					<% Auth::user()->nome %>
					<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu"> 
						<li><a href="<% url('/auth/logout') %>">Sair</a></li>
						<li><a href="<% url('/sobre') %>">Sobre</a></li>
					</ul>
				</li>
			</ul>
		</div>
		@endif
		@if(Auth::guest())
		<ul class="nav navbar-nav navbar-right">
			<li><a href="<% url('/sobre') %>">Sobre</a></li>
		</ul>
		@endif
	</div>
</nav> 
@yield('content')
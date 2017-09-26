@extends('app')
@section('content')
<link rel="stylesheet" type="text/css" href="<% asset('datepicker/css/datepicker.css') %>">
<script src="<% asset('js/lista_venda.js') %>"></script>
<script src="<% asset('datepicker/js/bootstrap-datepicker.js') %>"></script>
<script type="text/javascript">
            $(function () {
                $('#data-inicial').datepicker({
                   format: 'yyyy-mm-dd'
                });

                $('#data-final').datepicker({
                    format: 'yyyy-mm-dd'
                });
            });
</script>

<div class="container" ng-app="lista_modulo" ng-controller="lista_venda_controller">

<div style="float:left"><h3>Lista de Venda</h3>
	<div ng-show="!listaVazia()">
		Mostrando {{ from +' - '+ to}}
		<br>
		Página atual:
		<button class="btn btn-default" ng-click="next(prev_page)" title="Pagina anterior" ng-if="prev_page != null ">
		<span class="glyphicon glyphicon-chevron-left"></span>
		</button>
		{{ current_page }}
		<button class="btn btn-default" ng-click="next(next_page)" title="Proxima pagina" ng-if="next_page != null ">
		<span class="glyphicon glyphicon-chevron-right"></span>
		</button>
	</div>
</div>

<div  style="float:right">
<br>
<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Vendas <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="" ng-click="b_mes_anterior()">Mes Passado</a></li>
    <li><a href="" ng-click="b_hoje()">Hoje</a></li>
    <li><a href="" ng-click="b_mes()">Mes</a></li>
   </ul>
</div>
  
  De:<input type="text" id="data-inicial" readonly>
  Até:<input type="text" id="data-final" readonly>
  
  <button class="btn btn-default" ng-click="buscar()">Buscar</button>

  <button class="btn btn-default" ng-click="limpar()" title="limpar filtro e atualizar">
  	<span class="glyphicon glyphicon-refresh"></span>
  </button>
  <br>
  Qtd de itens em vendidos: {{total_item }}<br>
  Valor total vendido: R$ {{ total_vendido }}<br>
  
</div>

<table class="table table-hover table-striped table-condensed" ng-show="!listaVazia()">
	<tr>
		<th>Cod. venda</th>
		<th>Qtd Itens</th>
		<th>Valor</th>
		<th>Data da venda</th>
		<th>Ação</th>
	</tr>
	<tr ng-repeat="venda in lista" id="{{ venda.id }}">
		<td>{{ venda.id }}</td>
		<td>{{ venda.itens }}</td>
		<td>{{ venda.valor }}</td>
		<td>{{ venda.data }}</td>
		<td>
			<a href=""  ng-click="buscaDetalhe( venda.id )" class="btn btn-sm btn-primary">Detalhes</a>
		</td>
	</tr>
</table>

<div class="carregando col-md-12">
	<center>
	<img src="<% asset('img/loading.gif') %>"><br>
	Carregando...
	</center>
</div>

<!-- Modal novo local-->
	<div class="modal fade" id="ModalDetalhe">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title">Detalhes da venda {{ venda.id }}</h4>
	      </div>
	      <div class="modal-body">
	      	
	      	<table class="table table-condensed">
	      		<tr>
					<td>Data:</td>
					<td>{{ venda.data }}</td>
	      		</tr>
	      		<tr>
					<td>Valor:</td>
					<td>R$ {{ venda.valor }}</td>
	      		</tr>
	      		<tr>
					<td>Descrição:</td>
					<td>{{ venda.descricao }}</td>
	      		</tr>
	      		<tr>
					<td>Qtde itens:</td>
					<td>{{ venda.itens }}</td>
	      		</tr>
	      		<tr>
					<td>Desconto:</td>
					<td>{{ venda.desconto }}%</td>
	      		</tr>
	      		<tr>
					<td>Juros:</td>
					<td>{{ venda.juros }}</td>
	      		</tr>
	      		<tr>
					<td>Parcelas:</td>
					<td>{{ tipo(venda.parcelas) }}</td>
	      		</tr>
	      		<tr>
					<td>Nome do cliente:</td>
					<td>{{ venda.nome_representante }}</td>
	      		</tr>
	      		<tr>
					<td>CPF/CNPJ:</td>
					<td>{{ venda.cpf }}</td>
	      		</tr>
	      	</table>

	      </div><!--/modal body-->
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</div>
@endsection
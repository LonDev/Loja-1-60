@extends('app')
@section('content')
<script src="<% asset('js/lista_financeiro.js') %>"></script>
<div class="container" ng-app="lista_modulo" ng-controller="lista_financeiro_controller">

<div style="float:left">
<h3>Contas a pagar</h3>
 
   <div ng-show="lista.length > 0">
      Mostrando {{ from +' - '+ to}}
      <br>
      Página atual:
      <button ng-click="buscar(prev_page)" title="Pagina anterior" ng-if="prev_page != null ">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </button>
      {{ current_page }}
      <button ng-click="buscar(next_page)" title="Proxima pagina" ng-if="next_page != null ">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </button>
  </div>
</div>

<div  style="float:right">
  <br>
  <!-- Single button -->
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Contas <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="" ng-click="a_pagar()">Em aberto</a></li>
      <li><a href="" ng-click="pagas()">Pago</a></li>
    </ul>
  </div>
  <input type="text" ng-model="busca" placeholder="Busca rapida">
  <br>
   {{ msg +'R$ '+ valor_total }}
</div>

<table class="table table-hover table-striped table-condensed" ng-show="lista.length > 0">
	<tr>
		<th>Nota</th>
		<th>Fornecedor</th>
		<th>Valor</th>
		<th>Vencimento</th>
		<th>Ação</th>
	</tr>
	<tr ng-repeat="conta in lista | filter:busca">
   	<td>{{ conta.numero_nota }}</td>
    <td>{{ conta.FORNECEDOR }}</td>
		<td>R$ {{ conta.total_nota}}</td>
		<td>{{ conta.vencimento }}</td>
		<td>
      <button ng-click="quitar( conta.id )" class="btn btn-sm btn-success" ng-show="conta.quit == 0">Quitar Divida</button>
			<a href="<% url('venda/financeiro/notas/{{ conta.id }}') %>" class="btn btn-sm btn-primary">Editar</a>
			<button ng-click="delete_p( conta.numero_nota )" class="btn btn-sm btn-danger">Apagar</button>
		</td>
	</tr>
</table>

<!-- Modal novo setor-->
<div class="modal fade" id="ModalNovo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Cadastrar/Alterar Cliente</h4>
      </div>
      <div class="modal-body">
       
       <input type="hidden" id="id"/>
       <label>Nome:</label><input type="text" id="NOME" placeholder="Nome" class="form-control" required>
      	<br>
       <label>CPF/CNPJ:</label><input type="text" id="CPF_CNPJ" placeholder="CPF/CNPJ" class="form-control" required>
       <br>
       <label>Valor da divida:</label><input type="text" id="VALOR_DIVIDA" placeholder="Valor da divida" class="form-control" required>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="salvar" data-dismiss="modal">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- caso a lista esteja vazia -->
<div class="carregando col-md-12">
  <center>
  <img src="<% asset('img/loading.gif') %>"><br>
  Carregando...
  </center>
</div>
</div>
@endsection
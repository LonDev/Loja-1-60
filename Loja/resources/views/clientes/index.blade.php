@extends('app')
@section('content')
<div class="container" ng-app="lista_modulo" ng-controller="lista_cliente_controller">

<div style="float:left"><h3>Lista de Clientes</h3>
  Mostrando {{ from +' - '+ to}}
  <br>
  Página atual:
  <button ng-click="next(prev_page)" title="Pagina anterior" ng-if="prev_page != null ">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </button>
  {{ current_page }}
  <button ng-click="next(next_page)" title="Proxima pagina" ng-if="next_page != null ">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </button>
</div>

<div  style="float:right">
<br>
  <input type="text" ng-model="busca" placeholder="Busca rapida">
	<button title="Adicionar Funcionario" class="btn btn-default" ng-click="limpa()"  data-toggle="modal" data-target="#ModalNovo">
    <span class="glyphicon glyphicon-plus"></span>
  </button>
</div>

<table class="table table-hover table-striped table-condensed">
	<tr>
		<th>Nome</th>
		<th>CPF/CNPJ</th>
		<th>Divida ativa</th>
		<th>Valor da divida</th>
		<th>Ação</th>
	</tr>
	<tr ng-repeat="cliente in lista | filter:busca">
   	<td>{{ cliente.NOME }}</td>
		<td>{{ cliente.CPF_CNPJ }}</td>
		<td>{{ divida( cliente.DIVIDA_ATIVA ) }}</td>
		<td>R$ {{ cliente.VALOR_DIVIDA }}</td>
		<td>
      <button ng-click="quitar( cliente.id )" class="btn btn-sm btn-success" ng-if="cliente.DIVIDA_ATIVA == 1">Quitar Divida</button>
			<button ng-click="edit( cliente.id )" class="btn btn-sm btn-primary">Editar</button>
			<button ng-click="delete_p( cliente.id )" class="btn btn-sm btn-danger">Apagar</button>
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

</div>

<script src="<% asset('js/lista_cliente.js') %>"></script>
@endsection
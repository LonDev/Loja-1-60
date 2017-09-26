@extends('app')
@section('content')
<script src="<% asset('js/lista_usuario.js') %>"></script>

<div class="container" ng-app="lista_modulo" ng-controller="lista_usuario_controller">

<div style="float:left">
<h3>Lista de Funcionarios</h3>

  <div ng-show="lista.length > 0">
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

</div>

<div  style="float:right" ng-show="lista.length > 0">
<br>
  <input type="text" ng-model="busca" placeholder="Busca rapida">
	<button title="Adicionar Funcionario" class="btn btn-default" ng-click="limpa()"  data-toggle="modal" data-target="#ModalNovo">
    <span class="glyphicon glyphicon-plus"></span>
  </button>
</div>

<table class="table table-hover table-striped table-condensed" ng-show="lista.length > 0">
	<tr>
		<th>Nome</th>
		<th>Cargo</th>
		<th>Acesso</th>
		<th>Ação</th>
	</tr>
	<tr ng-repeat="usuario in lista | filter:busca">
   	<td>{{ usuario.nome }}</td>
		<td>{{ usuario.cargo }}</td>
		<td>{{ usuario.nivel_acesso }}</td>
		<td>
			<button ng-click="edit(usuario.id)" class="btn btn-sm btn-primary" ng-show="usuario.id > 2">editar</button>
			<button ng-click="delete_p(usuario.id)" class="btn btn-sm btn-danger" ng-show="usuario.id > 2">apagar</button>
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
        <h4 class="modal-title">Cadastrar Novo Funcionario</h4>
      </div>
      <div class="modal-body">
       
       <input type="hidden" id="id"/>
       <label>Nome:</label><input type="text" id="nome" placeholder="Nome" class="form-control" required>
      	<br>
       <label>Cargo:</label><input type="text" id="cargo" placeholder="Cargo" class="form-control" required>
       <br>
       <label>Acesso:</label>
       <select id="acesso" class="form-control" required>
       		<option value="">Selecione...</option>
       		<option value="administrador">administrador</option>
       		<option value="usuario">usuario</option>
       </select>

       <br>
       Alterar senha <input type="checkbox" id="chk">
       <br>
       <div class="altSenha">
        <label>Senha:</label><input type="password" id="senha" placeholder="senha" class="form-control" required>
        <br>
       
        <label>Confirme a senha:</label><input type="password" id="senha" placeholder="senha" class="form-control" required>
        <br>
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
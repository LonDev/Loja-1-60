@extends('app')
@section('content')
<div class="container"  ng-app="modulo_produto" ng-controller="produto_controller">
	<h4>Novo Produto</h4>

		<table class="table table-condensed">
			<tr>
				<td>
					* campos obirgatórios
				</td>
				<td>
					<button class="btn btn-sm btn-success" id="salvar">Salvar</button>
					@if(@$produto->id > 0)
						<button class="btn btn-sm btn-danger" ng-click="delete_p(<% $produto->id %>)">Apagar</button>
					@endif
				</td>
			</tr>
		</table>

	<form action="<% url('produtos/salvar') %>" method="post">
		<input type="hidden" name="_token" value="<% csrf_token() %>">
		<input type="hidden" name="id" value="<% @$produto->id %>">
		<input type="hidden" name="VISIVEL" value="1">

		<input type="hidden" ng-init="fornecedor_nome='<% @$produto->FORNECEDOR %>'">
		<input type="hidden" ng-init="localizacao_nome='<% @$produto->LOCAL %>'">
		<input type="hidden" ng-init="setor_nome='<% @$produto->SETOR %>'">
		
		<table class="table table-condensed">
			<tr>
				<td colspan="6">
					<label>Descrição do produto:  *</label></td>
			</tr>
			<tr>
				<td colspan="6">
					<input type="text" name="DESCRICAO" placeholder="EX.: bala de goma" class="form-control" value="<% @$produto->DESCRICAO %>" required></td>
			</tr>
			<tr>
				<td>
					<label>Medida:</label></td>
				<td colspan="5">
					<label>Fornecedor:</label></td>
			</tr>
			
			<tr>
				<td>
				<br>
					<select name="MEDIDA" class="form-control" >
						<option value="">Selecione</option>
						@foreach($MEDIDAS as $medida)
						<option value="<% $medida->unidades %>"
							@if(@$produto->MEDIDA == $medida->unidades)
								selected
							@endif><% $medida->unidades %></option>
						@endforeach
					</select>
				</td>
				<td colspan="5">
					<a href="<% url('fornecedor/novofornecedor') %>" class="btn-sm">Novo fornecedor</a>
					<select name="FORNECEDOR" class="form-control">
						<option value="">Selecione um Fornecedor</option>
						<option ng-repeat="fornecedor in fornecedores" value="{{ fornecedor.nome }}" ng-if="fornecedor_nome == fornecedor.nome" selected>{{ fornecedor.nome }}</option>
						<option ng-repeat="fornecedor in fornecedores" value="{{ fornecedor.nome }}">{{ fornecedor.nome }}</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<label>Observação:</label></td>
				<td colspan="5">
					<label>Localização do produto:</label></td>
			</tr>
			<tr>
				<td colspan="2">
					<br>
					<input type="text" name="OBS"  placeholder="Ex.: corredor dos fundos" class="form-control" value="<% @$produto->OBS %>"></td>
				<td colspan="5">
					<a href="" class="btn-sm" data-toggle="modal" data-target="#ModalLocal">Novo local</a>
					
					<select name="LOCAL" class="form-control">
						<option ng-repeat="local in localizacao" value="{{ local.nome }}" ng-if="localizacao_nome == local.nome" selected>{{ local.nome }}</option>

						<option value="">Selecione uma localização</option>
						
						<option ng-repeat="local in localizacao" value="{{ local.nome }}">
						{{ local.nome }}</option>
					</select>
				</td>	
			</tr>
			<tr>
				<td colspan="2">
					<label>Código de Barras: *</label></td>
				<td colspan="5">
					<label>Setor:</label></td>
			</tr>
			<tr>
				<td colspan="2">
					<br>
					<input type="text" name="REFERENCIA" id="REFERENCIA" class="form-control" value="<% @$produto->REFERENCIA %>" required></td>
				<td colspan="5">
					<a href="" class="btn-sm" data-toggle="modal" data-target="#ModalSetor">Novo Setor</a>
					
					<select name="SETOR" class="form-control" >
						<option ng-repeat="setors in setor" value="{{setors.nome }}" ng-if="setor_nome == setors.nome" selected>{{ setors.nome }}</option>

						<option value="">Selecione um Setor</option>
				
						<option ng-repeat="setors in setor" value="{{setors.nome }}">
						{{ setors.nome }}</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label>Quantidade estoque: *</label></td>
				<td>
					<label>Estoque critico:</label></td>
				<td colspan="5">
					<label>Situação: *</label></td>
			</tr>
			<tr>
				<td>
					<input type="text" name="QTD_ATUAL" value="<% @$produto->QTD_ATUAL %>" required></td>
				<td>
					<input type="text" name="QTD_MINIM" value="<% @$produto->QTD_MINIM %>"></td>
				<td colspan="5">
					<select name="ATIVO" required>
						<option value="">Selecione</option>
						<option value="1"
							@if(@$produto->ATIVO == true)
								selected
							@endif>Disponivel</option>
						<option value="0"
							@if(@$produto->ATIVO ==  false)
								selected
							@endif>Indisponivel</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Preço de Custo(R$):</label></td>
				<td><label>Margem de Lucro(%):</label></td>
				<td><label>Preço de Venda(R$): *</label></td>
				<td><label>Lucro do varejo(R$):</label></td>
				<td><label title="Margem de lucro do atacado(%)">Margem de lucro A.(%):</label></td>
				<td><label>Preço Atacado(R$):</label></td>
				
			</tr>
			<tr>
				<td>
					<input type="number" step="0.01" name="CUSTOCOMPR" id="CUSTOCOMPR" value="<% @$produto->CUSTOCOMPR %>"></td>
				<td>
					<input type="number" step="0.01" name="MARGEMLUCRO" id="MARGEMLUCRO" value="<% @$produto->MARGEMLUCRO %>"></td>
				<td>
					<input type="number" step="0.01" name="PRECO" id="PRECO" value="<% @$produto->PRECO %>" required></td>
				<td>
					<input type="number" step="0.01" name="LUCROVAREJO" id="LUCROVAREJO" value="<% @$produto->LUCROVAREJO %>"></td>
				<td>
					<input type="number" step="0.01" name="MARGEMATACADO" id="MARGEMATACADO" value="<% @$produto->MARGEMATACADO %>"></td>
				<td>
					<input type="number" step="0.01" name="PRECOATACADO" id="PRECOATACADO" value="<% @$produto->PRECOATACADO %>"></td>
			</tr>
		</table>
	</form>

<!-- Modal novo local-->
<div class="modal fade" id="ModalLocal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Cadastrar Novo Local</h4>
      </div>
      <div class="modal-body">
       <input type="text" id="local_nome" placeholder="Nome do local" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="salvaLocal" data-dismiss="modal">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal novo setor-->
<div class="modal fade" id="ModalSetor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Cadastrar Novo Setor</h4>
      </div>
      <div class="modal-body">
       <input type="text" id="setor_nome" placeholder="Nome do setor" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="salvaSetor" data-dismiss="modal">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal novo setor-->
<div class="modal fade" id="ModalForncedor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Cadastrar Novo Fornecedor</h4>
      </div>
      <div class="modal-body">
       <input type="text" id="fornecedor_nome1" placeholder="Nome do fornecedor" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="salvaFornecedor" data-dismiss="modal">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>
<script src="<% asset('js/produtosController.js') %>"></script>

@endsection
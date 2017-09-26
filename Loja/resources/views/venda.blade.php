<!DOCTYPE html>
<head>
	<!--meta http-equiv='cache-control' content='no-cache'-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<% asset('favicon.ico') %>" type="image/x-icon" >
	<title>Vendas - Menina sapeca</title> 
	
	<link href="<% asset('css/bootstrap.min.css') %>" rel="stylesheet">
	<link rel="stylesheet" href="<% asset('css/venda.css') %>">

	<script type="text/javascript" src="<% asset('js/jquery-1.11.3.min.js') %>"></script>
	<script type="text/javascript" src="<% asset('js/angular.min.js') %>"></script>
	<script type="text/javascript" src="<% asset('js/vendaController.js') %>"></script>
	<script type="text/javascript" src="<% asset('js/bootstrap.min.js') %>"></script>
</head>
<body ng-app="venda" ng-controller="vendaController">

<div class="container-fluid">
	
	<div class="head col-md-12">
		
		<!-- hint-->
		<div class="col-md-12 menu">
			<div class="col-md-2 ">
				<a href="" ng-click="sair()">Sair</a>
			</div>
			
			<div class="col-md-3 hint">
				<a href="" ng-click="finalizarVenda()">Finalizar Venda</a>
			</div>

			<div class="col-md-3 hint">
				<a href="" ng-click="buscaDescricao()">Busca Descrição</a>
			</div>
			
			<div class="col-md-3 hint">
				<a href="" ng-click="calculaAtacado()">Preço de Atacado</a>
			</div>

			<div class="col-md-2 hint">
				<a href="" ng-click="cancela(lista)">Cancelar Item</a>
			</div>
		</div>
		<!-- /hint -->

		<!-- cod de barras e quantidade-->
		<div class="col-md-9 busca">
			<small>Código de barras</small>
			<br>
			<input type="text" autocomplete="true" name="busca" id="busca" class="form-control">
		</div>

		<div class="col-md-9 busca-descricao">
			<small>Descrição</small>
			<br>			
			<input type="text" autocomplete="true" name="busca-descricao" id="busca-descricao" class="form-control">
		</div>


		<div  class="col-md-2">
			<small>Quantidade</small>
			<br>
			<input type="number" ng-model="quantidade" id="quantidade" class="form-control">
		</div>
		<!--/cd de barras e quantidade-->
	
		<!-- notaprint-->
		<div class="nota col-md-9">
			<div id="notaPrint">
				<table class="table-condensed table" width="90%">
					<tr>
						<th class="no_print"></th>
						<th>Item</th>
						<th>Descriçao</th>
						<th>Uni</th>
						<th>Preço($)</th>
						<th>Qtde</th>
						<th>subtotal</th>
					</tr>
					<tr ng-repeat="produto in lista" ng-class="{selecionado:produto.selecionado}">
						<td class="no_print"><input type="checkbox" ng-model="produto.selecionado"></td>
						<td>{{ $index + 1 }}</td>
						<td>{{ produto.DESCRICAO }}</td>
						<td>{{ produto.MEDIDA }}</td>
						<td>{{ produto.preco }}</td>
						<td>x {{ produto.qtde }}</td>
						<td>{{ produto.subtotal }}</td>
					</tr>
					<tr>
						<td class="no_print"></td>
						<td colspan="3"></td>
						<td>Total:</td>
						<td>{{ itens }} Itens</td>
						<td>R$ {{ total }}</td>
					</tr>
				</table>
			</div>

		</div>
		<!-- /notaPrint-->

		<!--sidebar-->
		<div class="nota_side col-md-3">
			<div class="balao atacado" >
				Venda á preço de Atacado
			</div>

			<div class="balao">
				Valor unitário:
				<br>
				R$ <span id="valorUnitario">{{ valorUnitario }}</span>
			</div>

			<div class="balao">
				Quantidade:
				<br>
				<span id="quantidade">{{ quantidade }}</span>
			</div>

			<div class="balao">
				Subtotal:
				<br>
				R$ <span id="subtotal">{{ subtotal }}</span>
			</div>

			<div class="total">
				Total
				<br>
				R$ <span id="total">{{ total }}</span>
			</div>
		</div>
	</div>
	<!--/sidebar-->

	<img src="<% asset('img/kiko.png') %>">
	
	<!-- modal personalizado para impressão da nota do cliente-->
	<div class="blackModal">
		<div class="ModalNota">
			<div class="tituloModal">
				<h4>Imprimir nota do cliente</h4>
				<hr>
			</div>
			<div class="corpoModal">
				<a href="<% url('venda.txt') %>" download ng-click="fimDownload()">Clique aqui para baixar a nota do cliente</a>					
			</div>
			<div class="footerModal">
				<button class="btn btn-default">Cancelar</button>
			</div>				
		</div>
	</div>
	<!--/ nota de cliente-->


	<!-- Modal novo local-->
	<div class="modal fade" id="ModalFinalizar">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title">Finalizar Venda</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="btns">
		      	<button id="aVista" class="btn btn-primary">Venda a vista</button>
		      	<button id="aPrazo" class="btn btn-primary">venda a prazo</button>
		    </div>

		    	<!-- venda a vista-->
	      		<div class="fim_aVista">
					<h3>Total R$ {{ total }}</h3>

			     	<!--label>Desconto</label>
			     	<br>
			     	<input id="desconto" type="number" step="1" />%
			     	
			     	<br><br-->
			     	<label>Valor pago</label>
			     	<br>
			     	<input id="valor_pago" type="number" step="0.05" />

			     	<br>
			     	<label>Troco do cliente</label>
			     	<br>
			     	<input id="troco" type="number" step="0.05" readonly/>
				</div>
				<!--/venda a vista-->

				<!--venda a prazo-->
				<div class="fim_aPrazo">
					<h3>Total R$ {{ total }}</h3>

			     	<label>Pracelas</label>
			     	<br>
			     	<input id="parcelas" type="number"/>X
			     	<br>
			     	<label>Juros</label>
			     	<br>
			     	<input id="juros" type="number"/>%

			     	<br><br>
			     	<label>Nome do representante/Cliente</label>
			     	<br>
			     	<input id="nome"  type="text" value="Não Obtido"/>
				
				</div>
				<!--/venda a prazo-->

				<br/><br/>
				<label>CPF do cliente(opcional)</label>
			     	<br>
			     	<input id="cpf" ng-model="cpf" type="text" placeholder="CPF" />
				

	      </div><!--/modal body-->
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" id="salvaVenda" data-dismiss="modal">Salvar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<!-- Modal novo local-->
	<div class="modal fade" id="ModalBusca">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title">Buscar por nome</h4>
	      </div>
	      <div class="modal-body">
	      	
	      	<table class="table table-condensed table-hover">
	      		<tr>
	      			<td>Descrição</td>
	      			<td>Preço V.</td>
	      			<td>Preço A.</td>
	      			<td>Qtde. Disponivel</td>
	      		</tr>
	      		<tr ng-repeat="descItem in listaTemp" ng-click="select( descItem )" data-dismiss="modal">
	      			<td>{{ descItem.DESCRICAO }}</td>
	      			<td>{{ descItem.PRECO }}</td>
	      			<td>{{ descItem.PRECOATACADO }}</td>
	      			<td>{{ descItem.QTD_ATUAL }}</td>
	      		</tr>
	      	</table>
		    	
	      </div><!--/modal body-->
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</div>
</body>
</html>
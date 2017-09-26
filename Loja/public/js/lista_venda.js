angular.module("lista_modulo",[])
.controller("lista_venda_controller",function($scope,$http){

	$scope.lista = [];

	//carrega a lista de vendas
$scope.buscarVenda = function()
{	
	$('.carregando').show();

	$http.get('/lista/venda').then(function(response){

		//primeiro item da lista atual
		$scope.from = response.data.ITEM.from;

		//ultimo item da lista atual
		$scope.to = response.data.ITEM.to;

		//mostra a pagina atual 
		$scope.current_page = response.data.ITEM.current_page;
		
		//link para a pagina anterior
		$scope.prev_page = response.data.ITEM.prev_page_url;

		//link para a proxima lista quando haja mais que 10
		$scope.next_page = response.data.ITEM.next_page_url;

		//carrega a lista de itens
		$scope.lista = response.data.ITEM.data;

		//total de itens vendidos
		$scope.total_item = response.data.VENDIDO;
		
		//total de itens vendidos
		$scope.total_vendido = response.data.VALOR;

		$('.carregando').hide();
	},
	function(){
		location.reload();
	});
}

$scope.buscarVenda();
	$scope.next = function(link)
	{
		//carrega a lista de vendas
		$http.get(link).then(function(response){
		
			//primeiro item da lista atual
			$scope.from = response.data.ITEM.from;

			//ultimo item da lista atual
			$scope.to = response.data.ITEM.to;

			//mostra a pagina atual 
			$scope.current_page = response.data.ITEM.current_page;
			
			//link para a pagina anterior
			$scope.prev_page = response.data.ITEM.prev_page_url;

			//link para a proxima lista quando haja mais que 10
			$scope.next_page = response.data.ITEM.next_page_url;

			//carrega a lista de itens
			$scope.lista = response.data.ITEM.data;

			//total de itens vendidos
			$scope.total_item = response.data.VENDIDO;
			
			//total de itens vendidos
			$scope.total_vendido = response.data.VALOR;
				
		});

	}

	//apaga um item da lista
	$scope.delete_v = function(id)
	{
		//exibe a mensagem de confirmação antes da apagar o item
		if(window.confirm("Deseja apagar esse item?"))
		{
			//envia a requição para apagar o item
			$http.get('/venda/'+id+'/delete').then(function(){
				$scope.buscarVenda();
			});
		}
	}

	//busca vendas por um intervalo predefinido
	$scope.buscar = function()
	{
		//recupera as datas da tela e adiciona um horario
		dataI = $('#data-inicial').val() +' 00:00:00';
		dataF = $('#data-final').val() +' 23:59:59';

		//se a data inicial for menor que a data final então faz a busca
		if(dataI < dataF)
		{
		
			$http.post('/venda/buscadata',{dataInicial: dataI,dataFinal: dataF})
			.then(function(response){
				
				//primeiro item da lista atual
				$scope.from = response.data.ITEM.from;

				//ultimo item da lista atual
				$scope.to = response.data.ITEM.to;

				//mostra a pagina atual 
				$scope.current_page = response.data.ITEM.current_page;
				
				//link para a pagina anterior
				$scope.prev_page = response.data.ITEM.prev_page_url;

				//link para a proxima lista quando haja mais que 10
				$scope.next_page = response.data.ITEM.next_page_url;

				//carrega a lista de itens
				$scope.lista = response.data.ITEM.data;

				//total de itens vendidos
				$scope.total_item = response.data.VENDIDO;
				
				//total de itens vendidos
				$scope.total_vendido = response.data.VALOR;
		
			});
		}
		else
		{
			alert('A data FINAL deve ser maior que a data INICIAL');
			$('#data-final').focus();
		}
	}

	$scope.listaVazia = function()
	{
		if($scope.lista.length == 0)
		{
			return true;
		}
		
		return false;
	}

	//limpa os campos data inicial e data final e retorna a lista original
	$scope.limpar = function()
	{
		$scope.lista = $scope.listaOriginal;
		$('#data-inicial').val('');
		$('#data-final').val('');
	}

	$scope.b_hoje = function()
	{
		//recupera a data atual
		var data = new Date();
		var dia = data.getDate();
		var mes = data.getMonth();
		var ano = data.getFullYear();

		//corrige o mes
		mes++;

		if(dia < 10)
		{
			dia = '0'+dia;
		}
		if(mes < 10)
		{
			mes = '0'+mes;
		}

		//transforma a data em string para exibição nos input
		var data_inicial = ano +'-'+ mes +'-'+ dia;

		//seta as datas nos campos data inicial e data final
		var dataI = $('#data-inicial').val(data_inicial);
		var dataF = $('#data-final').val(data_inicial);

		$scope.buscar();
	}

	$scope.b_mes = function()
	{
		//recupera a data atual
		var data = new Date();
		var dia = data.getDate();
		var mes = data.getMonth();
		var ano = data.getFullYear();

		//corrige o mes
		mes++;
		
		if(mes < 10)
		{
			mes = '0'+mes;
		}

		//transforma a data em string para exibição nos input
		var data_inicial = ano +'-'+ mes +'-'+ '01';

		//altera o mes
		mes++;
		var data_final = ano +'-'+ mes +'-'+ '01';

		//seta as datas nos campos data inicial e data final
		var dataI = $('#data-inicial').val(data_inicial);
		var dataF = $('#data-final').val(data_final);

		$scope.buscar();
	}

	$scope.b_mes_anterior = function()
	{
		//recupera a data atual
		var data = new Date();
		var dia = data.getDate();
		var mes = data.getMonth() - 1;
		var ano = data.getFullYear();

		//corrige o mes
		mes++;
		
		if(mes < 10)
		{
			mes = '0'+mes;
		}

		//transforma a data em string para exibição nos input
		var data_inicial = ano +'-'+ mes +'-'+ '01';

		//altera o mes
		mes++;
		var data_final = ano +'-'+ mes +'-'+ '01';

		//seta as datas nos campos data inicial e data final
		var dataI = $('#data-inicial').val(data_inicial);
		var dataF = $('#data-final').val(data_final);

		$scope.buscar();
	}


	//caso o tipo de venda for avista, ou seja parcela == 0 retorna o texto venda a vista
	$scope.tipo = function(tipo)
	{
		if(tipo == 0)
		{
			return "Venda á vista.";
		}
		return tipo;
	}

	$scope.patrimonio = function()
	{
		$http.get('/venda/patrimonio').then(function(response){
			//total de itens vendidos
			$scope.total_vendido = response.data.VALOR;

		})
	}

	$scope.buscaDetalhe = function(id)
	{
		$http.get('/venda/detalhes/'+id).then(function(response){
			$scope.venda = response.data;
			$('#ModalDetalhe').modal();
		});
	}

});
angular.module("lista_modulo",[])
.controller("lista_produto_controller",function($scope,$http){
	
	$scope.lista = [];

	$scope.buscar = function()
	{
		$('.carregando').show();

		$http.get('/lista').then(function(response){

			//primeiro item da lista atual
			$scope.from = response.data.from;

			//ultimo item da lista atual
			$scope.to = response.data.to;

			//mostra a pagina atual 
			$scope.current_page = response.data.current_page;
			
			//link para a pagina anterior
			$scope.prev_page = response.data.prev_page_url;

			//link para a proxima lista quando haja mais que 10
			$scope.next_page = response.data.next_page_url;

			//carrega a lista de itens
			$scope.lista = response.data.data;

			//total de registros
			$scope.total_stock = response.data.total;

			$scope.patrimonio();

			$('.carregando').hide();
		},
		function(){
			location.reload();
		});
	}

	$scope.buscar();

	$scope.next = function(link)
	{
		//carrega a lista de vendas
		$http.get(link).then(function(response){

				//primeiro item da lista atual
				$scope.from = response.data.from;

				//ultimo item da lista atual
				$scope.to = response.data.to;

				//mostra a pagina atual 
				$scope.current_page = response.data.current_page;
				
				//link para a pagina anterior
				$scope.prev_page = response.data.prev_page_url;

				//link para a proxima lista quando haja mais que 10
				$scope.next_page = response.data.next_page_url;

				//carrega a lista de itens
				$scope.lista = response.data.data;
		});

	}

	$scope.delete_p = function(id)
	{
		if(window.confirm("Deseja apagar esse item?"))
		{
			$http.get('/produtos/'+id+'/delete').then(function(){
				$scope.buscar();				
			});
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

	$scope.situacao = function(status)
	{
		if(status == true)
		{
			return 'Disponivel';
		}
		
		return 'Indisponivel';
	}

	$scope.patrimonio = function()
	{
		$http.get('/produtos/patrimonio').then(function(response){
			//patrimonio total baseado no custo de compra
			$scope.total_custo = response.data.TOTAL_CUSTO;
	
			//patrimonio total baseado no preco de estipulado dos produtos
			$scope.total_venda = response.data.TOTAL_PRECO;


		});
	}


});
angular.module("lista_modulo",[])
.controller("lista_financeiro_controller",function($scope,$http){

	//endereço padrao da lista de contas em aberto.
	var lista_padrao = '/lista/financeiro';
	
	$scope.buscar = function(url)
	{
		$('.carregando').show();
		//carrega a lista de usuarios do sistema
		$http.get(url).then(function(response){
			//primeiro item da lista atual
			$scope.from = response.data.nota.from;

			//ultimo item da lista atual
			$scope.to = response.data.nota.to;

			//mostra a pagina atual 
			$scope.current_page = response.data.nota.current_page;
			
			//link para a pagina anterior
			$scope.prev_page = response.data.nota.prev_page_url;

			//link para a proxima lista quando haja mais que 10
			$scope.next_page = response.data.nota.next_page_url;

			//carrega a lista de itens
			$scope.lista = response.data.nota.data;

			//valor total em contas a pagar
			$scope.valor_total = response.data.valor_total;

			$('.carregando').hide();
		},
		function(){
			location.reload();
		});

	}

	//quitar a nota e atualiza a lista
	$scope.quitar = function(id)
	{
		$http.get('/venda/financeiro/notas/quitar/'+id).then(function(response){
			$scope.buscar(lista_padrao);
			
		});

	};

	//carrega as contas pagas
	$scope.pagas = function()
	{
		$scope.msg = 'Total pagas: ';
		$scope.buscar('/lista/financeiro/pagas');
	}

	$scope.a_pagar = function()
	{
		$scope.msg = 'Total em aberto: ';
		$scope.buscar(lista_padrao);
	}

		//chama a lista
	$scope.a_pagar();


	//apaga o usuário
	$scope.delete_p = function(id)
	{
		//exibe a tela de confirmação para a exclusão do item
		if(window.confirm("Deseja apagar esse item?"))
		{
			//apaga um usuario baseadi no ID
			$http.get('/venda/financeiro/delete/'+id).then(function(){
				
				$scope.buscar(lista_padrao);
			});
		}
	}

});
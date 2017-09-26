angular.module("lista_modulo",[])
.controller("lista_cliente_controller",function($scope,$http){

	//carrega a lista de usuarios do sistema
	$http.get('/lista/clientes').then(function(response){
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

	$scope.buscar = function()
	{
		//carrega a lista de usuarios do sistema
		$http.get('/lista/clientes').then(function(response){
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
	 
	//carrega os dados do usuario para edição
	$scope.edit = function(id)
	{
		$http.get('/clientes/load/'+id).then(function(response){
			
			//preenche os campos
			$('#id').val(response.data.id);
			$('#NOME').val(response.data.NOME);
			$('#CPF_CNPJ').val(response.data.CPF_CNPJ);

			//chama o modal com os dados recebidos
			$('#ModalNovo').modal();
		});

	};

	//apaga o usuário
	$scope.delete_p = function(id)
	{
		//exibe a tela de confirmação para a exclusão do item
		if(window.confirm("Deseja apagar esse item?"))
		{
			//apaga um usuario baseadi no ID
			$http.get('/clientes/'+id+'/delete').then(function(){
				
				$scope.buscar();
			});
		}
	}

	$scope.limpa = function()
	{
		$('input').val('');
		$('select').val('');

	}

	$scope.divida = function(status)
	{
		if(status == 0)
		{
			return "Não tem";
		}

		return "Sim";
	}

	$scope.quitar = function(id)
	{
		$http.get('/clientes/quitar/'+id).then(function(response){
			$scope.buscar();
		});

	}

	//salva usuario
	$('#salvar').click(function(){
		
		//cria um obj json com os dados do modal
		var cliente = {
			id: $('#id').val(),
			NOME: $('#NOME').val(),
			CPF_CNPJ:$('#CPF_CNPJ').val(),
			VALOR_DIVIDA:$('#VALOR_DIVIDA').val()
		};

		//salva o usuario
		$http.post('/clientes/salvar', cliente).then(function(){
			$scope.buscar();

		});
	});

});
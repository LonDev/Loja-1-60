angular.module("lista_modulo",[])
.controller("lista_usuario_controller",function($scope,$http){

$scope.buscar = function()
{
	$('.carregando').show();
	//carrega a lista de usuarios do sistema
	$http.get('/lista/usuario').then(function(response){
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

	//abre a tela de alteração de senha
	 $("#chk").change(function(){
		if($("#chk").is(':checked'))
			$(".altSenha").slideDown();  // checked
		else
			$(".altSenha").slideUp();  // unchecked
	});
	 
	//carrega os dados do usuario para edição
	$scope.edit = function(id)
	{
		$http.get('/funcionarios/'+id+'/load').then(function(response){
			
			//preenche os campos
			$('#id').val(response.data[0].id);
			$('#nome').val(response.data[0].nome);
			$('#cargo').val(response.data[0].cargo);
			$('#acesso').val(response.data[0].nivel_acesso);

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
			$http.get('/funcionarios/'+id+'/delete').then(function(){
				$scope.buscar();
			});
		}
	}

	$scope.limpa = function()
	{
		$('input').val('');
		$('select').val('');

	}

	//salva usuario
	$('#salvar').click(function(){
		
		//cria um obj json com os dados do modal
		var usuario = {
			id: $('#id').val(),
			nome: $('#nome').val(),
			cargo:$('#cargo').val(),
			nivel_acesso: $('#acesso').val()
		};

		//se for atualizado a senha
		if($("#chk").is(':checked') && $('#senha').val() !='')
		{	
			usuario.password = $('#senha').val();
		}

		//salva o usuario
		$http.post('/funcionarios/salvar', usuario).then(function(){
			
			//atualiza a lista
			$http.get('/lista/usuario').then(function(response){
				$scope.buscar();
				$('input:text').val('');
			});
		});


	});

});
angular.module("lista_modulo",[])
.controller("lista_fornecedor_controller",function($scope,$http){
	$scope.lista = [];

	$scope.buscar = function()
	{	
		$('.carregando').show();

		$http.get('/lista/fornecedor').then(function(response){
			//carrega a lista de itens
			$scope.lista = response.data;
			$('.carregando').hide();
		},
		function(){
			location.reload();
		});
	}

	$scope.buscar();

	$scope.delete_f = function(id)
	{
		if(window.confirm("Deseja apagar esse item?"))
		{
			$http.get('/fornecedor/'+id+'/delete').then(function(){
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
});
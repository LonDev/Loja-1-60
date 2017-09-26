angular.module("modulo_fornecedor",[])
.controller("fornecedor_controller",function ($scope,$http){

	$('form').submit(function(e){
		e.preventDefault();
	});

	
	$('#salvar').click(function(){
		dado = $('form').serialize();

		$.post('/fornecedor/salvar', dado,function(){
			location = '/fornecedor';
		})
		.fail(function(){
			alert('Por Favor, preencha todos os campos obrigatorios');
		});

	});
	
});
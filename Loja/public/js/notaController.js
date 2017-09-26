angular.module("nota_modulo",[])
.controller("nota_controller",function($scope,$http){
	$scope.lista = [];

	$('form').submit(function(e){
			e.preventDefault();
	});

	$scope.buscaFornecedor = function(id)
	{
		$http.get('/fornecedor/busca/'+id).then(function(response){
			$scope.fornecedor = response.data;
		});
	}

	$scope.buscaProduto = function(id)
	{
		$http.get('/venda/financeiro/notas/produtos/'+id).then(function(response){
			for(i = 0; i < response.data.length; i++)
			{
				$scope.escreveProduto(response.data[i]);
			}
		});
	}

	var num = 0;//$('#itens').val();//varialvel de controle de quantidade de produtos da nota
	$scope.escreveProduto = function(item)
	{
		num++;
		$('#itens').val(num);//seta a propriedade quantidade de itens na nota
				
		$('form').submit(function(e){
			e.preventDefault();
		});

		$('#table-descricao').append('<tr><td><input type="text" name="descricao_'+num+'" value="'+item.descricao+'" class="form-control"></td>\
			<td><input type="number" name="quantidade_'+num+'" value="'+item.quantidade+'"></td>\
			<td><input type="number" step="0.01" name="unitario_'+num+'" value="'+item.unitario+'"></td>\
			<td><input type="number" step="0.01" name="total_'+num+'" value="'+item.total+'"></td></tr>');
		
		$('#produto').val('');
	};

	$scope.select = function(item)
	{
		var num = $('#itens').val();//varialvel de controle de quantidade de produtos da nota
		num++;
		$('#itens').val(num);//seta a propriedade quantidade de itens na nota
	
		
		$('form').submit(function(e){
			e.preventDefault();
		});
		
		$('#table-descricao').append('<tr><td><input type="text" name="descricao_'+num+'" value="'+item.DESCRICAO+'" class="form-control"></td>\
			<td><input type="number" name="quantidade_'+num+'" value="'+item.QTD_ATUAL+'"></td>\
			<td><input type="number" step="0.01" name="unitario_'+num+'" value="'+item.CUSTOCOMPR+'"></td>\
			<td><input type="number" step="0.01" name="total_'+num+'" value="'+(item.QTD_ATUAL * item.CUSTOCOMPR).toFixed(2)+'"></td></tr>');
		
		$('#produto').val('');
	};

	$scope.apagar = function(lista)
	{
		
	}

	//salva a nota
	$('#salvar').click(function(){
		var dado = $('form').serialize();

		$.post('/venda/financeiro/notas/salvar',dado,function(){
			location ='/venda/financeiro/contas';
		});
	});

	//quando inicia o controller com um fornecedor setado, carrega o restante da informação
	var fornecedorID = $('#fornecedor').val();

	if(fornecedorID != '')
	{	
		var notaID = $('#numero_nota').val();

		$scope.buscaFornecedor(fornecedorID);
		if(notaID != '')
		$scope.buscaProduto(notaID);
	}

	$('#fornecedor').change(function(){
		$scope.buscaFornecedor($('#fornecedor').val());

	});

	//busca o produto por parte do nome(descricao)
	$('#busca').click(function(){
		$('form').submit(function(e){
			e.preventDefault();
		});

		var busca = $('#produto').val();
		$http.get('/produtos/busca/descricao/'+busca).then(function(response){
			
			//caso a busca não traga resultado, dispara um alerta
			if(response.data != "")
			{
				$scope.lista = response.data;
				$('#ModalBusca').modal();
				
			}
			else
			{
				alert('Nenhum produto encontrado com descrição começando com '+busca);
			}
		});
	});

});
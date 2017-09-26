angular.module("modulo_produto",[])
.controller("produto_controller",function ($scope,$http){

	$('form').submit(function(e){
		e.preventDefault();
	});

	
	$('#salvar').click(function(){
		dado = $('form').serialize();

		$.post('/produtos/salvar', dado,function(){
			location = '/produtos';
		})
		.fail(function(){
			alert('Por Favor, preencha todos os campos obrigatorios');
		});

	});
	

	$http.get('/lista/fornecedor').then(function(response){
		$scope.fornecedores = response.data;
	});

	$http.get('/lista/localizacao').then(function(response){
		$scope.localizacao = response.data;
	});

	$http.get('/lista/setor').then(function(response){
		$scope.setor = response.data;
	});

	//cadastra fornecedor
	$("#salvaFornecedor").click(function(){
		var dado = $('#fornecedor_nome1').val();
		if(dado != "")
		{
			$http.post('/fornecedor/salvar',{nome: dado}).then(function(){			
		
				$http.get('/lista/fornecedor').then(function(response){
					$scope.fornecedores = response.data;
				});
			});
		}
	});

	//cadastra local
	$("#salvaLocal").click(function(){
		var dado = $('#local_nome').val();
		if(dado != "")
		{
			$http.post('/localizacao/salvar',{nome: dado}).then(function(){			
		
				$http.get('/lista/localizacao').then(function(response){
					$scope.localizacao = response.data;
				});
			});
		}
	});

	//cadastra setor
	$("#salvaSetor").click(function(){
		var dado = $('#setor_nome').val();
		if(dado != "")
		{
			$http.post('/setor/salvar',{nome: dado}).then(function(){			
		
				$http.get('/lista/setor').then(function(response){
					$scope.setor = response.data;
				});
			});
		}
	});

	$('#PRECO').keypress(function(event){
		if(event.key =='Enter')
		{
			var custo = Number($('#CUSTOCOMPR').val());
			var preco = Number($('#PRECO').val());
		
			margem = preco * 100 / custo - 100;
			varejo = preco - custo;

			$('#MARGEMLUCRO').val(parseFloat(margem).toFixed(2));
			$('#LUCROVAREJO').val(varejo);

		}

	});

	$('#PRECOATACADO').keypress(function(event){
		if(event.key =='Enter')
		{
			var custo = Number($('#CUSTOCOMPR').val());
			var preco = Number($('#PRECOATACADO').val());
		
			margem = preco * 100 / custo - 100;
			varejo = preco - custo;

			$('#MARGEMATACADO').val(parseFloat(margem).toFixed(2));

		}

	});

	$('#MARGEMLUCRO').keypress(function(event){
		if(event.key == 'Enter')
		{
			var custo = Number($('#CUSTOCOMPR').val());
			var margem = Number($('#MARGEMLUCRO').val());
			
			var margem_lucro = (custo * margem) /100;
			var venda = custo + margem_lucro;
			var varejo = venda - custo;

			$('#LUCROVAREJO').val(varejo);
			$('#PRECO').val(venda);
		}

	});

	$('#MARGEMATACADO').keypress(function(event){
		if(event.key == "Enter")
		{
			var custo = Number($('#CUSTOCOMPR').val());
			var margem = Number($('#MARGEMATACADO').val());
			
			var margem_lucro = (custo * margem) /100;
			var venda = custo + margem_lucro;
			
			$('#PRECOATACADO').val(venda);
		}
	});

	//valida a existencia do produto baseado no cod de barras
	$('#REFERENCIA').keypress(function(event){
		if (event.key == 'Enter')
		{
			var ref = $('#REFERENCIA').val();

			$http.get('/produtos/valida/'+ref).then(function(response){
				if(response.data == 1)
				{
					alert('Atenção\nEsse produto já existe!\nSe você clicar em salvar, irá atulizar o produto ja existe.');
				}
			});

		}
	});


//apaga um item
	$scope.delete_p = function(id)
	{
		$('form').submit(function(e){
			e.preventDefault();
		});

		if(window.confirm("Deseja apagar esse item?"))
		{
			$http.get('/produtos/'+id+'/delete').then(function(){
				location = "/produtos/";
			});
		}
	}
});
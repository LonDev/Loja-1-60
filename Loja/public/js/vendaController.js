angular.module("venda",[])
.controller("vendaController",function($scope,$http){
		
	$scope.atacado = false;
	$scope.quantidade = 1;
	$scope.itens = 0;

	$scope.valorUnitario = 0;
	$scope.subtotal = 0;
	$scope.lista = [];
	$scope.listaTemp = [];
	$scope.total = 0;
	
	//monitora o campo de busca
	$('#busca').focus();

	$('#busca').keypress(function(event){
		if(event.key == 'Enter')
		{
			var busca = $('#busca').val();		

			$http.get('/produtos/busca/'+busca).then(function(response){
				
				if(response.data != "")
				{
					//obtem o valor por item. varejo ou atacado
					if(!$scope.atacado)
					{
						//varejo
						$scope.valorUnitario = parseFloat(response.data.PRECO).toFixed(2);
						response.data.preco = parseFloat(response.data.PRECO).toFixed(2);
					}
					else
					{
						//atacado
						$scope.valorUnitario = parseFloat(response.data.PRECOATACADO).toFixed(2);
						response.data.preco = parseFloat(response.data.PRECOATACADO).toFixed(2);
					}

					//calcula o subtotal
					$scope.subtotal = ($scope.quantidade * $scope.valorUnitario).toFixed(2);
					
					//atribui os campos subtotal e quantidade ao objeto
					response.data.subtotal = parseFloat($scope.subtotal).toFixed(2);

					response.data.qtde = $scope.quantidade;

					//calcula o total
					$scope.total = (parseFloat($scope.total) + parseFloat($scope.subtotal)).toFixed(2);

					//adiciona item a lista
					$scope.lista.push(response.data);

					//atualiza a quantidade de itens na nota
					$scope.itens = $scope.itens + response.data.qtde;

					//restaura a quantidade inicial para 1
					$scope.quantidade = 1;

					$('#busca').val('');

				}
				else
				{
					alert('Produto indisponivel ou não cadastrado');
					$('#busca').val('');
				}
			});
			
		}
		
	});

	//busca produto por parte do nome
	$('#busca-descricao').keypress(function(event){
		if (event.key == 'Enter')
		{
			var busca = $('#busca-descricao').val();
			$http.get('/produtos/busca/descricao/'+busca).then(function(response){
				
				//caso a busca não traga resultado, dispara um alerta
				if(response.data != "")
				{
					$scope.listaTemp = response.data;
					$('#ModalBusca').modal();
				}
				else
				{
					alert('Nenhum produto encontrado com descrição começando com '+busca);
				}
			});
		}
	});

	$scope.buscaDescricao = function()
	{

		$('.busca-descricao').toggle();
		$('.busca').toggle();
		$('#busca-descricao').focus();

	}

	//Quando selecionao um item na lista por descrição, faz o mesmo processamento de busca
	$scope.select = function(obj)
	{
		if(obj != "")
			{
				//obtem o valor por item. varejo ou atacado
				if(!$scope.atacado)
				{
					//varejo
					$scope.valorUnitario = parseFloat(obj.PRECO).toFixed(2);
					obj.preco = parseFloat(obj.PRECO).toFixed(2);
				}
				else
				{
					//atacado
					$scope.valorUnitario = parseFloat(obj.PRECOATACADO).toFixed(2);
					obj.preco = parseFloat(obj.PRECOATACADO).toFixed(2);
				}

				//calcula o subtotal
				$scope.subtotal = ($scope.quantidade * $scope.valorUnitario).toFixed(2);
				
				//atribui os campos subtotal e quantidade ao objeto
				obj.subtotal = parseFloat($scope.subtotal).toFixed(2);

				obj.qtde = $scope.quantidade;

				//calcula o total
				$scope.total = (parseFloat($scope.total) + parseFloat($scope.subtotal)).toFixed(2);

				//adiciona item a lista
				$scope.lista.push(obj);

				//atualiza a quantidade de itens na nota
				$scope.itens = $scope.itens + obj.qtde;

				//restaura a quantidade inicial para 1
				$scope.quantidade = 1;

				$('#busca').val('');
				$('#busca-descricao').val('');

				$scope.buscaDescricao();
			}

	}

	$scope.finalizarVenda = function()
	{
		$('#ModalFinalizar').modal();
	};

	//função de cancelamento de item por lista
	$scope.cancela = function(lista)
	{
		$scope.lista = lista.filter(function(item){
			return !item.selecionado;
		});

		//recalcula o total e a quantidade de itens
		$scope.total = 0;
		$scope. itens = 0;

		//calcula o subtotal
		$scope.subtotal = 0;
		$scope.valorUnitario = 0;


		for(i = 0; i < $scope.lista.length; i++)
		{
			//calcula o total
			//calcula o subtotal
			$scope.valorUnitario = $scope.lista[i].preco;
			$scope.subtotal = ($scope.quantidade * $scope.lista[i].preco).toFixed(2);
			$scope.total = (parseFloat($scope.total) + parseFloat($scope.lista[i].preco)).toFixed(2);
			$scope.itens = $scope.itens + $scope.lista[0].qtde;
		}
	};

	//calcula o desconto e troco do cliente
	$scope.calculaValor = function(){
		var troco = 0;
		var desconto = Number( $('#desconto').val() );
		var total = $scope.total;
		var valor_pago = Number( $('#valor_pago').val() );

		if(desconto > 0)
		{
			var val_desconto =  (total * desconto) / 100;
			troco =  ( $('#valor_pago').val() - (total - val_desconto) ).toFixed(2);
			//$scope.total = total - (total * (desconto/100) );

		}
		else
		{
			troco = ( $('#valor_pago').val() - $scope.total ).toFixed(2);
		}

		//caso o valor pago seja menor que o total da compra avisa sobre o desconto
		if(valor_pago < total)
		{
			var valor_dado = ( total - valor_pago).toFixed(2);

			alert('Atenção!!\nVocê está dando R$'+valor_dado+' de desconto.');
		}

		$('#troco').val(troco);

	};

	//ativa função de preço de atacado
	$scope.calculaAtacado = function(){

		$scope.atacado = !$scope.atacado;
		$('.atacado').fadeToggle();
	};

	$scope.sair = function(){
		if(window.confirm("Deseja fechar essa tela?"))
		{
			window.close();	
		}
	};

	$scope.salvaVenda = function(){

		$scope.calculaValor();
		
		$('.no_print').hide();
		
		var desconto = $('#desconto').val();
		var troco = $('#troco').val();
		var cpf = $('#cpf').val();
		var parcelas = $('#parcelas').val();
		var juros = $('#juros').val();
		var nome = $('#nome').val();
		var descricoes = '';
		var n_descricoes = '';
		var n_preco = '';
		var n_qtde = 0;
		var n_subtotal = 0;

		//calcula as descrições 
		for(b = 0; b < $scope.lista.length; b++)
		{
			descricoes = descricoes +$scope.lista[b].qtde+'x'+$scope.lista[b].DESCRICAO +' '+$scope.lista[b].preco+'\n';
			n_descricoes =  n_descricoes+$scope.lista[b].DESCRICAO+'\n';
			n_preco = n_preco+$scope.lista[b].preco+'\n';
			n_qtde = n_qtde+$scope.lista[b].qtde+'\n';
			n_subtotal = n_subtotal+$scope.lista[b].subtotal+'\n'; 

		}
	
		//cria o obj json com os dados da venda
		var venda = {
			itens: $scope.itens,
			valor: $scope.total,
			desconto: desconto,
			cpf: cpf,
			parcelas: parcelas,
			juros: juros,
			nome_representante: nome,
			descricao: descricoes,
			descricoes_n: n_descricoes,
			preco_n: n_preco,
			qtde_n: n_qtde,
			subtotal_n: n_subtotal
		};
		
		//salva as informações sobre a venda
		$.post('/venda/salvar',venda,function(data){
			var lista = $scope.lista;

			//numero de vezes que o produto aparece concecutivamente 
			var vezes = 0;
			
			//percorre a lista do que foi vendido para baixar no estoque
			for(i = 0; i < lista.length; i++)
			{	
				//se a quantidade de produto for maior que 1 entao incrementa a quantidade de produtos
				// e armazena na variavel 'vezes'. Apos isso dispara a requisição com o ID e Quantidade
				if(lista[i].qtde > 1)
				{
					for(j = 0; j < lista[i].qtde;j++)
					{
						vezes++;
					}

					$.post('/produtos/update',{id: lista[i].id,qtde: vezes})
						.error(function(data){
							alert("Erro\n"+data);
						}); 

					vezes = 0;
				}

				//senao dispara uma unica vez a requição para baixar do estoque
				else
				{
					$.post('/produtos/update',{id: lista[i].id, qtde: vezes})
					.error(function(data){
						alert("Erro\n"+data);
					}); 
				}
			}

			//exibe a mensagem de sucesso vinda atraves da variavel 'data'

			$('.blackModal').show();
 		
		})
		.error(function(data){
			alert("Erro:\n"+data);
		});
		
	};

	$scope.fimDownload = function()
	{
		alert('Venda finalizada com sucesso.');
		location.reload();
	}

	//botao salvar venda
	$('#salvaVenda').click(function(){
		$scope.salvaVenda();
	});
	//botao a vista
	$('#aVista').click(function(){		
		$('.fim_aPrazo input').val("");
		$('#cpf').val('Não obtido');
		$('#nome').val('Não obtido');
		$('.fim_aPrazo').slideUp();
		
		//limpa os campos
		$('.fim_aVista input').val("");
		$('.fim_aVista').slideToggle();

	});

	//botao prazo
	$('#aPrazo').click(function(){
		//limpa os campos
		$('.fim_aVista input').val("");
		$('.fim_aVista').slideUp();

		$('.fim_aPrazo input').val("");
		$('#cpf').val('Não obtido');
		$('#nome').val('Não obtido');
		$('.fim_aPrazo').slideToggle();
	});

	//calcula o desconto e troco do cliente
	$('#valor_pago').change(function(){
		$scope.calculaValor(); 
	});

	$('#desconto').keypress(function(event){
		if(event.key == 'Enter')
		$scope.calculaValor(); 
	});

	//monitora o botao do footer da tela de impressao de nota
	$('.footerModal button').click(function(){
		alert('Venda finalizada com sucesso.');
		location.reload();
	});

/*
	$(document).keypress(function(event){
		//monitora as teclas de atalho
		switch(event.key)
		{
			case 'Escape':
			$scope.sair();
			break;

			case 'F2':
			$scope.finalizarVenda();
			break;

			case 'F8':
			$scope.buscaDescricao();
			break;

			case 'F4':
			$scope.calculaAtacado();
			break;

		}

	});
*/

});//escopo controller
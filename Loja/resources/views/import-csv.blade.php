@extends('app')
@section('content')
	<div class="container">
		<h3>Importar base de dados csv</h3>

		<form  method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<% csrf_token() %>">
			<input type="file" name="arquivo">
			<button class="btn btn-default">salvar</button>
		</form>
	<br/>

<?php
function conecta(){
	$host		= "localhost";
	$dbName 	= "loja";
	$user		= "root";
	$password	=""; 

	try{
		$pdo = new PDO("mysql:host=$host;dbname=$dbName",$user,$password);
		
	}catch(PDOException $e){
		echo "Erro ao conectar-se com o banco de dados <br>
		Erro: ".$e->getMessage();
	}
	return $pdo;
}

function insere($dado)
{
	$pdo = conecta();
	$insere = $pdo->prepare("INSERT INTO estoque (REFERENCIA, DESCRICAO, NOME, FORNECEDOR, MEDIDA, PRECO, CUSTOCOMPR, QTD_ATUAL, QTD_MINIM, QTD_INICIO, ULT_VENDA, OBS, QTD_VEND, CUS_VEND,  ATIVO, VISIVEL) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	
	$dado[26] = 1;//ativo
	$dado[27] = 1; //visivel
	
	//colunas da tabela
	$insere->bindParam(1, $dado[1] );
	$insere->bindParam(2, $dado[2] );
	$insere->bindParam(3, $dado[3] );
	$insere->bindParam(4, $dado[4] );
	$insere->bindParam(5, $dado[5] );
	$insere->bindParam(6, $dado[6] );
	$insere->bindParam(7, $dado[7] );
	$insere->bindParam(8, $dado[10] );
	$insere->bindParam(9, $dado[11] );
	$insere->bindParam(10, $dado[12] );
	$insere->bindParam(11, $dado[15] );
	$insere->bindParam(12, $dado[21] );
	$insere->bindParam(13, $dado[22] );
	$insere->bindParam(14, $dado[23] );
	$insere->bindParam(15, $dado[26] );
	$insere->bindParam(16, $dado[27] );

	if(!$insere->execute())
	{
		echo "Erro ao cadastrar";
	}
}

function insereFornecedor($dado)
{
	$pdo = conecta();
	
	//compara o que ja esta cadastrado visando evitar que haja duplicidade de fornecedores
	$busca = $pdo->prepare("SELECT nome FROM fornecedors WHERE nome=:nome");
	$busca->bindValue(":nome",$dado[4]);
	$busca->execute();
	
	if($busca->rowCount() == 0)
	{

		$insere = $pdo->prepare("INSERT INTO fornecedors (nome) VALUES (?)");

		$insere->bindParam(1, $dado[4]);

		if(!$insere->execute())
		{
			echo "Erro ao cadastrar Fornecedor";
		}

	}

}

//verifica se o campo não esta vazio
if(@$_FILES['arquivo']['name'] != "")
{
	if(move_uploaded_file($_FILES['arquivo']['tmp_name'],'base.csv'))
	{
		$row = 0;
		//tenta abrir o arquivo
		if (($handle = fopen("base.csv", "r")) !== FALSE)
		{	
			//percorre a lista de itens 
			while(($dados = fgetcsv($handle, 1000, ",","'")) !== FALSE)
			{
				insere($dados);
				insereFornecedor($dados);
				$row++;
			}
		}
		fclose($handle);
		echo "$row registros foram inseridos.<br>
		Base atualizada com sucesso.<br>
		<a href='http://localhost/phpmyadmin'>Gerenciar base de dados</a>";
	}
	else
	{
		echo 'erro ao salvar base de dados';
	}
}
?>
</div>
@endsection
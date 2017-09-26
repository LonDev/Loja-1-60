<?php 
namespace londev\Http\Controllers;

use DB;
use londev\Http\Models\Venda;
use londev\Http\Models\Config;

class VendaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{	
		return view('venda');
	}

	public function financeiro()
	{
		return view('financeiro/index');
	}

	public function cabecalho()
	{
		$config = Config::select('descricao_nota')->first();
		return $config;
	}
	
	public function salvar()
	{
		Venda::create(request()->all());

		$descricao = explode("\n", request()->descricoes_n);

		$qtde = explode("\n", request()->qtde_n);

		$preco = explode("\n", request()->preco_n);

		$subtotal = explode("\n", request()->subtotal_n);

		$total = request()->valor;

		$total_itens = request()->itens;

		//escreve o arquivo para impressão da nota
		$arq = fopen("venda.txt", "w");

		$cabecalho = $this->cabecalho();

		fseek($arq, 0, SEEK_CUR );

		fwrite($arq, $cabecalho->descricao_nota." ".date('d/m/Y')."\r\n");

		fwrite($arq, "---------------------------------------------\r\n");

		fwrite($arq, "# Descricao	Un	Preço Qtde Subtotal\r\n");
		
		for($i = 0; $i < number_format($total_itens); $i++)
		{
			fwrite($arq,($i+1)." ".$descricao[$i]." ".$preco[$i]." x".$qtde[$i]." ".$subtotal[$i]."\r\n");
		}

		fwrite($arq, "---------------------------------------------\r\n");

		fwrite($arq,$total_itens." itens. Total: R$ ".$total);

		fwrite($arq,"\r\n\r\nObrigado pela preferência, volte sempre.");

		fclose($arq);

		return 'Venda finalizada com sucesso.';
	}
	
	public function destroy()
	{
		Venda::find(request()->id)->delete();

	}
	//envia a lista por json
	public function lista()
	{	
		$qtde_vendida = 0;
		$venda = Venda::select('id', 'itens', 'created_at', 'valor')->Paginate(Config::paginacao());

		foreach ($venda as $item)
		{
			//cria a data baseada no campo de criação do obj
			$date = date_create($item->created_at);

			//cria o campo data no obj
			$item->data = date_format($date,'d/m/Y - H:i');

			$qtde_vendida = $qtde_vendida + $item->itens;

		}

		$valor = $this->patrimonio();
		
		return ['VALOR'=>$valor,'VENDIDO'=>$qtde_vendida, 'ITEM'=>$venda];
	}

	public function detalhes()
	{	
		$venda = Venda::where('id', request()->id)->first();

		//cria a data baseada no campo de criação do obj
			$date = date_create($venda->created_at);

		//cria o campo data no obj
			$data = date_format($date,'d/m/Y - H:i');

		$item = [
			'id'=>$venda->id,
			'valor'=>$venda->valor,
			'descricao'=>$venda->descricao,
			'itens'=>$venda->itens,
			'juros'=>$venda->juros,
			'parcelas'=>$venda->parcelas,
			'desconto'=>$venda->desconto,
			'data'=>$data,
			'nome_representante'=>$venda->nome_representante,
			'cpf'=>$venda->cpf
		];
		
		return $item;
	}
	
	public function buscadata()
	{
		$valor = 0;
		$qtde_vendida = 0;

		$venda = Venda::select('id', 'itens', 'created_at', 'valor')
		->whereBetween('created_at',[request()->dataInicial,request()->dataFinal])
		->Paginate(Config::paginacao());

		foreach ($venda as $item)
		{
			//cria a data baseada no campo de criação do obj
			$date = date_create($item->created_at);

			//cria o campo data no obj
			$item->data = date_format($date,'d/m/Y - H:i');

			$qtde_vendida = $qtde_vendida + $item->itens;

			$valor = $valor + $item->valor;
		}

		return ['VALOR'=>number_format($valor, 2, ',','.'),'VENDIDO'=>$qtde_vendida, 'ITEM'=>$venda];
	}

	public function patrimonio()
	{
		$valor = 0;
		$venda = Venda::select('valor')->get();

		foreach ($venda as $item)
		{
			$valor = $valor + $item->valor;
		}

		return number_format($valor, 2, ',','.');
	}

}

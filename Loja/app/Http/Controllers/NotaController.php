<?php 
namespace londev\Http\Controllers;

use londev\Http\Models\Config;
use londev\Http\Models\Nota;
use DB;

class NotaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{
		return view('financeiro/contas');
	}
	
	public function lista()
	{	
		$valor_total = 0;
		$nota = Nota::select('id','numero_nota','id_fornecedor','total_nota', 'vencimento', 'quit')
		->where('quit',0)
		->orderby('numero_nota','asc')
		->Paginate(Config::paginacao());

		//adiciona o nome do fornecedor ao obj nota, que é puxado com base no id do fornecedor
		foreach ($nota as $item)
		{
			$valor_total = $valor_total + $item->total_nota;
			
			$fornecedor = DB::table('fornecedors')->where('id', $item->id_fornecedor)->value('nome');
			$item->FORNECEDOR = $fornecedor;
		}

		
		return ['nota'=>$nota, 'valor_total'=>number_format($valor_total, 2, ',','.')];
	}

		public function listaQuitada()
	{	
		$valor_total = 0;
		$nota = Nota::select('id','numero_nota','id_fornecedor','total_nota', 'vencimento', 'quit')
		->where('quit',1)
		->orderby('numero_nota','asc')
		->Paginate(Config::paginacao());

		//adiciona o nome do fornecedor ao obj nota, que é puxado com base no id do fornecedor
		foreach ($nota as $item)
		{
			$valor_total = $valor_total + $item->total_nota;
			
			$fornecedor = DB::table('fornecedors')->where('id', $item->id_fornecedor)->value('nome');
			$item->FORNECEDOR = $fornecedor;
		}

		
		return ['nota'=>$nota, 'valor_total'=>number_format($valor_total, 2, ',','.')];
	}


	public function create()
	{
		$fornecedor = DB::table('fornecedors')->select('nome','id')->where('nome','<>','')->distinct('nome')->orderby('nome','asc')->get();

		return view('financeiro/create',['fornecedores'=>$fornecedor]);
	}

	public function edit()
	{
		$num = 0;
		$nota = Nota::find(request()->id);
		$fornecedor = DB::table('fornecedors')->select('nome','id')->where('nome','<>','')->distinct('nome')->orderby('nome','asc')->get();
		$produtos = DB::table('descricao_notas')->where('id_nota', $nota->numero_nota)->get();

		return view('financeiro/create',['nota'=>$nota, 'fornecedores'=>$fornecedor, 'produtos'=>$produtos, 'num'=>$num]);
	}

	public function salvar()
	{

		if(request()->id > 0)
		{
			Nota::find(request()->id)->update(request()->all());

		}
		else
		{
			Nota::create(request()->all());
		}

		//apaga o produto relacionado e cria novamente
		DB::table('descricao_notas')->where('id_nota', request()->numero_nota)->delete();

		//grava varias descrições de produtos relacionados a nota
		for($i = 0; $i < request()->itens; $i++)
			{
				$num = $i+1;
				$descricao = "descricao_$num";
				$quantidade = "quantidade_$num";
				$unitario = "unitario_$num";
				$total = "total_$num";

				DB::table('descricao_notas')->insert([
					'id_nota'=>request()->numero_nota,
					'descricao'=>request()->$descricao,
					'quantidade'=>request()->$quantidade,
					'unitario'=>request()->$unitario,
					'total'=>request()->$total
					]);
			}	

	}

	public function produtos()
	{
		$produtos = DB::table('descricao_notas')->where('id_nota',request()->id)->get();

		return $produtos;
	}

	public function busca()
	{
		$nota = Nota::find(request()->id);

		return $nota;
	}
	
	public function quitar()
	{
		Nota::where('id', request()->id)->update(['quit'=>1]);
	}
	
	public function destroy()
	{
		Nota::where('numero_nota', request()->id)->delete();
		//apaga o produto relacionado e cria novamente
		DB::table('descricao_notas')->where('id_nota', request()->id)->delete();

	}
		public function patrimonio()
	{
		$preco = 0;
		$custo = 0;

		$produto = Produtos::select('PRECO', 'CUSTOCOMPR', 'QTD_ATUAL')->where('ATIVO',1)
		->where('VISIVEL',1)
		->get();

		foreach ($produto as $item)
		{
			$preco = $preco + ($item->PRECO * $item->QTD_ATUAL);
			$custo = $custo + ($item->CUSTOCOMPR * $item->QTD_ATUAL);
		}

		return ['TOTAL_PRECO'=>number_format($preco, 2, ',','.') , 'TOTAL_CUSTO'=>number_format($custo, 2, ',','.')];
	}
	
}
?>
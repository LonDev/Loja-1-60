<?php 
namespace londev\Http\Controllers;

use DB;
use londev\Http\Models\Produtos;
use londev\Http\Requests\ProdutoRequest;
use londev\Http\Models\Config;

class ProdutosController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{	
		return view('produtos/index');
	}
	
	public function lista()
	{	
		$produto = Produtos::select('ID','QTD_ATUAL','DESCRICAO', 'MEDIDA', 'PRECO', 'ATIVO', 'REFERENCIA', 'updated_at')
		->where('VISIVEL',1)
		->Paginate(Config::paginacao());

		foreach ($produto as $item)
		{
			//cria a data baseada no campo de criação do obj
			$date = date_create($item->updated_at);

			//cria o campo data no obj
			$item->data = date_format($date,'d/m/Y');
		}

		return $produto;
	}
	
	public function create()
	{
		$medidas = DB::table('medidas_config')->select('unidades')->get();
		return view('produtos/create',['MEDIDAS'=>$medidas]);	
	}

	public function edit()
	{	
		$produto = Produtos::find(request()->id);
		$medidas = DB::table('medidas_config')->select('unidades')->get();

		return view('produtos/create', [ 'produto'=>$produto, 'MEDIDAS'=>$medidas ]);
	}
	
	public function salvar(ProdutoRequest $request)
	{
		//caso haja um produto que ja esteja cadastrado pelo cod de barras
		$item = Produtos::where('REFERENCIA',request()->REFERENCIA)->first();
		if($item !="")
		{
			$item->update(request()->all());
		}

		if(request()->id > 0)
		{
			Produtos::find(request()->id)->update(request()->all());
		}
		else
		{
			$input = $request->all();
			Produtos::create($input);
		}
	}
	
	public function destroy()
	{
		//desabilita o produto para venda sem apaga-lo
		Produtos::where('id',request()->id)->update( [ 'ATIVO'=>0, 'VISIVEL'=>0 ] );
	}

	public function update()
	{
		//busca pelo valor do campo quantidade do produto
		$produto = Produtos::where('id',request()->id)->value('QTD_ATUAL');

		//verifica a quantidade a baixar do produto em estoque
		if(request()->qtde > 0)
		{
			$produto = $produto - request()->qtde;
		}
		else
		{
			//se a quantidade nao for passada baixa apenas 1 item daquele produto
			$produto = $produto - 1;
		}

		//atualiza no banco de dados a quantidade
		Produtos::where('id',request()->id)->update(['QTD_ATUAL'=>$produto]);
		
	}

	public function busca()
	{
		//Busca produto para a venda caso ele esteja disponivel e visivel e com quantidade maior que 0
		$produto = Produtos::select('id', 'DESCRICAO', 'MEDIDA', 'PRECOATACADO', 'PRECO')
		->where('REFERENCIA',request()->id)
		->orwhere('id',request()->id)
		->where('VISIVEL',1)
		->where('ATIVO',1)
		->where('QTD_ATUAL','>',0)->first();

		return $produto;
	} 

	public function buscaDescricao()
	{
		//Busca produto para a venda caso ele esteja disponivel e visivel e com quantidade maior que 0
		$produto = Produtos::select('id', 'DESCRICAO', 'MEDIDA', 'PRECOATACADO', 'PRECO', 'QTD_ATUAL','CUSTOCOMPR')
		->where('DESCRICAO','like',request()->desc.'%')
		->where('VISIVEL',1)
		->where('ATIVO',1)
		->where('QTD_ATUAL','>',0)
		->orderby('DESCRICAO','ASC')->get();

		return $produto;
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

	public function valida()
	{
		$produto = Produtos::select('REFERENCIA')->where('REFERENCIA', request()->id)->first();

		if($produto !="")
		{
			return 1;
		}
		return 0;
	}
}

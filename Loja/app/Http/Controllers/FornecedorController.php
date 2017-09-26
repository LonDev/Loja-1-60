<?php 
namespace londev\Http\Controllers;

use londev\Http\Models\Fornecedor;
use londev\Http\Requests\FornecedorRequest;
use DB;

class FornecedorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{
		return view('fornecedor/index');
	}
	
	public function lista()
	{	
		$fornecedor = Fornecedor::select('id','nome')
		->where('nome','<>','')
		->distinct()
		->orderby('nome','asc')
		->get();
		
		return $fornecedor;
	}
	
	public function create()
	{
		$medidas = DB::table('medidas_config')->select('operadoras','forma_entrega')
		->where('operadoras','<>','')
		->where('forma_entrega','<>','')
		->get();

		return view('fornecedor/create',['MEDIDAS'=>$medidas]);
	}

	public function salvar()
	{
		if(request()->id > 0)
		{
			Fornecedor::find(request()->id)->update(request()->all());
		}
		else
		{
			Fornecedor::create(request()->all());
		}

	}

	public function edit()
	{
		$fornecedor = Fornecedor::find(request()->id);
		$medidas = DB::table('medidas_config')->select('operadoras','forma_entrega')
		->where('operadoras','<>','')
		->where('forma_entrega','<>','')
		->get();

		return view('fornecedor/create',['fornecedor'=>$fornecedor, 'MEDIDAS'=>$medidas]);
	}

	public function busca()
	{
		$fornecedor = Fornecedor::find(request()->id);

		return $fornecedor;
	}
	/*
	
	public function destroy()
	{
		Fornecedor::find(request()->id)->delete();
	}
	
	/*
	
	public function update()
	{
		Produtos::find(request()->id)->update(request()->all());
		
		return redirect()->route('produtos');
	}
	*/
}
?>
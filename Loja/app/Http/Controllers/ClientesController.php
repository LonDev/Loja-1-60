<?php 
namespace londev\Http\Controllers;

use londev\Http\Models\Clientes;
use londev\Http\Models\Config;

class ClientesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{	
		return view('clientes/index');
	}

	public function salvar()
	{
		if(request()->id > 0)
		{
			Clientes::find(request()->id)->update(request()->all());
		}
		else
		{
			Clientes::create(request()->all());
		}

	}

	public function lista()
	{	
		$clientes = Clientes::select('id','NOME', 'CPF_CNPJ', 'DIVIDA_ATIVA','VALOR_DIVIDA')
		->simplePaginate( Config::paginacao() );

		return $clientes;
	}

	public function load()
	{
		$clientes = Clientes::select('id','NOME', 'CPF_CNPJ')->where('id', request()->id)
		->first();

		return $clientes;
	}

	public function destroy()
	{
		Clientes::find(request()->id)->delete();
	}

	public function quitar()
	{
		//atualiza no banco de dados a quantidade
		Clientes::where('id',request()->id)->update(['VALOR_DIVIDA'=>0,'DIVIDA_ATIVA'=>0]);

	}

	public function calculaDivida()
	{
		$valores = Venda::select('valor')->where('cpf', $cpf)->get();
	}

}

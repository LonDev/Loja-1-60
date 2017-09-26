<?php 
namespace londev\Http\Controllers;

use londev\Http\Models\Localizacao;
use Illuminate\http\Request;

class LocalizacaoController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{	
		$localizacao = Localizacao::select('nome')
		->distinct()
		->orderby('nome','asc')
		->get();
		
		return $localizacao;
	}

	public function salvar(Request $request)
	{
		$input = $request->all();
		Localizacao::create($input);
	}
	
}
?>
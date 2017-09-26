<?php 
namespace londev\Http\Controllers;

use londev\Http\Models\Setor;
use Illuminate\http\Request;

class SetorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{	
		$setor = Setor::select('nome')
		->distinct()
		->orderby('nome','asc')
		->get();
		
		return $setor;
	}

	public function salvar(Request $request)
	{
		$input = $request->all();
		Setor::create($input);
	}
	
}
?>
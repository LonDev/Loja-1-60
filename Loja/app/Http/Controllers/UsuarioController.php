<?php 
namespace londev\Http\Controllers;

use DB;
use londev\User;
use londev\Http\Models\Config;
use Illuminate\http\Request;

class UsuarioController extends Controller
{
	//autentica a sessão no construtor
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    //tela indice de usuários
	public function index()
	{	
		$usuario = User::all();
		
		return view('funcionarios/index');
	}
	
	//envia a lista por json
	public function lista()
	{	
		$usuario = DB::table('users')->select('id','nome','cargo','nivel_acesso')
		->simplePaginate( Config::paginacao() );
		
		return $usuario;
	}
	
	//salva e altera os usuários da aplicação
	public function salvar()
	{
		//cria um array com os dados vindos da requisição e criptografa a senha
		if(request()->password != '')
		{
			$user = [		
			'nome' => request()->nome,
			'password' => bcrypt(request()->password),
			'cargo' => request()->cargo,
			'nivel_acesso' => request()->nivel_acesso
			];
		}
		else
		{
			$user = [		
			'nome' => request()->nome,
			'cargo' => request()->cargo,
			'nivel_acesso' => request()->nivel_acesso
			];
		}
	
		if(request()->id > 0)
		{
			User::find(request()->id)->update($user);
		}
		else
		{
			User::create($user);
		}

	}
	
	public function destroy()
	{
		User::find(request()->id)->delete();
	}

	public function load()
	{
		$usuario = DB::table('users')->select('id','nome','cargo','nivel_acesso')
		->where('id',request()->id)->get();
		
		return $usuario;
	} 

}

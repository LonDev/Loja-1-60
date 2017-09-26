<?php 
namespace londev\Http\Controllers;

use DB;
use londev\Http\Models\Config;

class ConfigController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{	
		$medidas = DB::table('medidas_config')->select('paginacao')->where('paginacao','>',0)->get();
		$config = Config::first();

		return view('config/index',[ 'config'=>$config ,  'MEDIDAS'=>$medidas ]);
	}

	public function salvar()
	{

		if(request()->id > 0)
		{
			Config::find(request()->id)->update(request()->all());
		}
		else
		{
			Config::create(request()->all());
		}

		return redirect('/control');
	}
	
}

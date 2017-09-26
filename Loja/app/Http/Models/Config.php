<?php

namespace londev\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	protected $table = 'config';
	protected $fillable = ['nome_loja','paginacao','descricao_nota','fundo_venda']; 


	public static function paginacao()
	{
		$valor = Config::select('paginacao')->first();

		return $valor->paginacao;
	}
}

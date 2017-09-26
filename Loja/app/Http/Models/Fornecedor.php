<?php

namespace londev\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = ['nome','endereco','numero','bairro','cep','cidade','estado','cnpj','incricao_estado','telefone_1','telefone_2','email','telefone_representante', 'representante','celular','operadora', 'email_representante','site','limite','prazo','forma_entrega'];


    public function produtos()
    {
    	return $this->hasMany('londev\Produtos');
    }
}

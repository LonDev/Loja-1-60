<?php

namespace londev\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['NOME','CPF_CNPJ','DIVIDA_ATIVA','VALOR_DIVIDA']; 
}

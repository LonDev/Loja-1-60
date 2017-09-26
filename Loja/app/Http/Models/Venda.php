<?php

namespace londev\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    //
   protected $fillable = ['itens','valor','desconto','cpf','parcelas','juros','nome_representante', 'descricao'];
}

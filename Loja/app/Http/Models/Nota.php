<?php

namespace londev\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
	protected $table = "notas";
    protected $fillable =['numero_nota', 'id_fornecedor', 'vencimento', 'total_nota', 'tipo_nota','itens'];
}

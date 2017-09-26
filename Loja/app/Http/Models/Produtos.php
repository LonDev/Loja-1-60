<?php

namespace londev\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
	protected $table = 'estoque';
	protected $fillable = ['QTD_ATUAL','DESCRICAO', 'MEDIDA', 'VAL_VEND', 'ATIVO', 'ULT_COMPRA', 'FORNECEDOR','OBS','LOCAL','REFERENCIA','SETOR','QTD_MINIM','ATIVO','CUSTOCOMPR','MARGEMLUCRO','PRECO','LUCROVAREJO','MARGEMATACADO','PRECOATACADO', 'VISIVEL'];
}

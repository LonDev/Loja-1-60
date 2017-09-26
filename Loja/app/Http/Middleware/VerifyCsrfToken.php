<?php

namespace londev\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = ['venda/salvar','produtos/update'];
//    ['setor/salvar', 'venda/salvar', 'funcionarios/salvar', 'produtos/update'];
}

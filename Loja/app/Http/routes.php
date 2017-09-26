<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('sobre', function(){
	return view('sobre');
});

Route::get('importar', function(){ return view('import-csv'); });

Route::post('importar', function(){ return view('import-csv'); });

Route::get('control', 'ConfigController@index');

Route::post('control/salvar', 'ConfigController@salvar');

//localização
Route::post('localizacao/salvar','LocalizacaoController@salvar');

//setor
Route::post('setor/salvar','SetorController@salvar');

//produtos
Route::group(['prefix'=>'produtos', 'where'=>['id'=>'[0-9]+', 'desc'=>'[A-z]+']],function(){
	
	Route::get('', ['as'=>'produtos','uses'=>'ProdutosController@index']);

	Route::get('novoproduto',['as'=>'produtos.create','uses'=>'ProdutosController@create']);

	Route::post('salvar',['as'=>'produtos.store','uses'=>'ProdutosController@salvar']);

	Route::get('{id}/delete',['as'=>'produtos.delete','uses'=>'ProdutosController@destroy']);

	Route::get('{id}/edit',['as'=>'produtos.edit','uses'=>'ProdutosController@edit']);

	Route::get('patrimonio','ProdutosController@patrimonio');

	Route::post('update',['as'=>'produtos.update','uses'=>'ProdutosController@update']);

	Route::get('busca/{id}','ProdutosController@busca');

	Route::get('busca/descricao/{desc}','ProdutosController@buscaDescricao');

	Route::get('valida/{id}','ProdutosController@valida');
});

//clientes
Route::group(['prefix'=>'clientes', 'where'=>['id'=>'[0-9]+', 'desc'=>'[A-z]+']],function(){
	
	Route::get('', 'ClientesController@index');

	Route::post('salvar','ClientesController@salvar');

	Route::get('{id}/delete','ClientesController@destroy');

	Route::get('load/{id}','ClientesController@load');

	Route::get('quitar/{id}','ClientesController@quitar');

	Route::get('patrimonio','ProdutosController@patrimonio');
});

//listas
Route::group(['prefix'=>'lista'],function(){

	Route::get('','ProdutosController@lista');

	Route::get('setor','SetorController@index');

	Route::get('fornecedor','FornecedorController@lista');

	Route::get('localizacao','LocalizacaoController@index');

	Route::get('usuario','UsuarioController@lista');

	Route::get('venda','VendaController@lista');

	Route::get('clientes','ClientesController@lista');

	Route::get('financeiro','NotaController@lista');

	Route::get('financeiro/pagas','NotaController@listaQuitada');
});

//fornecedor
Route::group(['prefix'=>'fornecedor', 'where'=>['id'=>'[0-9]+']],function(){
	
	Route::get('/novofornecedor','FornecedorController@create');

	Route::get('', 'FornecedorController@index');

	Route::post('salvar','FornecedorController@salvar');

	Route::get('{id}/delete','FornecedorController@destroy');

	Route::get('busca/{id}','FornecedorController@busca');

	Route::get('{id}/edit','FornecedorController@edit');

});

//venda
Route::group(['prefix'=>'venda', 'where'=>['id'=>'[0-9]+']],function(){
	
	Route::get('','VendaController@index');

	Route::get('financeiro','VendaController@financeiro' );

	Route::get('financeiro/contas','NotaController@index');

	Route::get('financeiro/notas','NotaController@create');

	Route::get('financeiro/notas/{id}','NotaController@edit');

	Route::get('financeiro/notas/quitar/{id}','NotaController@quitar');

	Route::post('financeiro/notas/salvar','NotaController@salvar');

	Route::get('financeiro/notas/produtos/{id}','NotaController@produtos');

	Route::get('financeiro/delete/{id}','NotaController@destroy');

	Route::post('salvar','VendaController@salvar');

	Route::get('cabecalho','VendaController@cabecalho');

	Route::post('buscadata','VendaController@buscadata');

	Route::get('buscadata','VendaController@buscadata');

	Route::get('detalhes/{id}','VendaController@detalhes');

	Route::get('patrimonio','VendaController@patrimonio');
});

//Funcionario que na verdade é Usuario
Route::group(['prefix'=>'funcionarios', 'where'=>['id'=>'[0-9]+']],function(){
	
	Route::get('',['as'=>'funcionarios','uses'=>'UsuarioController@index'] );

	Route::post('salvar',['as'=>'funcionarios.store','uses'=>'UsuarioController@salvar']);

	Route::get('{id}/load','UsuarioController@load');

	Route::get('{id}/delete',['as'=>'produtos.delete','uses'=>'UsuarioController@destroy']);
});

Route::auth();

Route::get('/login', 'Auth\AuthController@index');

Route::post('/login', 'Auth\AuthController@authenticate');

Route::get('auth/logout', 'Auth\AuthController@logout');
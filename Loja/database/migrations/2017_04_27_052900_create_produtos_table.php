<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('descricao',50);
            $table->string('unidade',2);
            $table->string('referencia',50);
            $table->string('codigo_de_barras',50);
            
            $table->integer('codigo_do_produto')->unsigned()->unique();
            
            $table->decimal('preco_custo',5,2);
            $table->decimal('margem_lucro',5,2);
            $table->decimal('preco_venda',5,2);
            $table->decimal('margem_atacado',5,2);
            $table->decimal('preco_atacado',5,2);
            $table->decimal('lucro_varejo',5,2);
            
            $table->integer('quantidade');
            $table->integer('quantidade_critico');
            
            $table->string('situacao',15);

            $table->integer('fornecedor_id')->unsigned();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors');
            
            $table->integer('localizacao_id')->unsigned();
            $table->foreign('localizacao_id')->references('id')->on('localizacaos');
            
            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')->references('id')->on('setors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produtos');
    }
}

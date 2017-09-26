<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('itens')->unsigned();
            $table->decimal('valor',5,2);
            $table->integer('desconto');
            $table->string('cpf',15);
            $table->integer('parcelas')->unsigned();
            $table->decimal('juros',5,2);
            $table->string('nome_representante',50);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vendas');
    }
}

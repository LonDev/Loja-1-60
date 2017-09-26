<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nome',50);
            $table->string('endereco',50);
            $table->string('numero',50);
            $table->string('bairro',50);
            $table->string('cep',50);
            $table->string('cidade',50);
            $table->string('estado',2);
            $table->string('telefone_1',50);
            $table->string('telefone_2',50);
            $table->string('email',50);
            $table->string('telefone_representante',50);
            $table->string('representante',50);
            $table->string('celular',50);
            $table->string('operadora',50);
            $table->string('email_representante',50);
            $table->string('site',50);
            $table->string('forma_entrega',20);

            $table->integer('cnpj');
            $table->integer('incricao_estado');
            $table->integer('limite');
            $table->integer('prazo');

            //$table->string('credito',15);
            //$table->string('boleto',15);
            //$table->string('parcelado',15);  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fornecedors');
    }
}

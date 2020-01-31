<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lojas', function (Blueprint $table) {
            $table->increments('lojaid');
            $table->string('razaosocial', 150);
            $table->string('fantasia', 150)->nullable();
            $table->string('adcionalfantasia', 80)->nullable();
            $table->string('tipofj', 2)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('endereco', 150)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 80)->nullable();
            $table->string('bairro', 80)->nullable();
            $table->string('pontoreferencia', 150)->nullable();
            $table->string('municipio', 150)->nullable();
            $table->string('uf', 2)->nullable();
            $table->double('lat')->nullable();
            $table->string('lgn')->nullable();
            $table->boolean('ativo')->default(true);
            $table->boolean('possuipromotor')->default(false);
            $table->boolean('excluido')->default(false);
            $table->integer('idrede')->nullable();
            $table->string('telefone','10')->nullable();
            $table->string('celular','10')->nullable();
            $table->string('email','60')->nullable();
            $table->string('codintegracao','60')->nullable();


            $table->timestamps();
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->increments('visitaid');
            $table->integer('visita_aparelho_id');
            $table->integer('userid');
            $table->integer('lojaid');
            $table->date('ckin_dth')->nullable();
            $table->double('ckin_lat')->nullable();
            $table->double('ckin_lgn')->nullable();
            $table->date('ckout_dth')->nullable();
            $table->double('ckout_lat')->nullable();
            $table->double('ckout_lgn')->nullable();
            $table->string('observacao',200)->nullable();


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
        //
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItensVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_vendas', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('idMudas')->unsigned()->nullable();
            $table->foreign('idMudas')->references('id')->on('mudas')->onDelete('restrict');

            $table->integer('idVenda')->unsigned()->nullable();
            $table->foreign('idVenda')->references('id')->on('vendas')->onDelete('restrict');

            $table->integer('quant');
            $table->double('precoUn',10,2);
            $table->double('precoTotal',10,2);
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

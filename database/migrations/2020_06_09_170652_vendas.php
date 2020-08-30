<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vendas extends Migration
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
            $table->string('documento');
            $table->date('data');
            $table->double('precoTotalVenda',10,2);
            $table->integer('idClientes')->unsigned()->nullable();
            $table->foreign('idClientes')->references('id')->on('clientes')->onDelete('restrict');
            $table->integer('idUsers')->unsigned()->nullable();
            $table->foreign('idUsers')->references('id')->on('users')->onDelete('restrict');
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

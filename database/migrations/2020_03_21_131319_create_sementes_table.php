<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSementesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sementes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomePopular');
            $table->string('nomeCientifico')->nullable();
            $table->double('peso_100')->nullable();
            $table->double('quant_total')->nullable();
            $table->string('observacao')->nullable();
            $table->string('localColeta')->nullable();
            $table->date('dataColeta')->nullable();
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
        Schema::dropIfExists('sementes');
    }
}

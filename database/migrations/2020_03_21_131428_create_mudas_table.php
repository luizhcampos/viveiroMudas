<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMudasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mudas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomePopular');
            $table->string('nomeCientifico')->nullable();
            $table->integer('quant');
            $table->date('dataPlantio')->nullable();
            $table->double('precoMuda',10,2);
            $table->string('blocoPlantio');
            $table->string('canteiroPlantio');
            $table->string('estagioMuda');
            $table->string('tipoPlantio')->nullable();
            $table->integer('idSubstratos')->unsigned();
            $table->foreign('idSubstratos')->references('Substratos')->on('id');
            $table->integer('idSementes')->unsigned();
            $table->foreign('idSementes')->references('Sementes')->on('id');
            $table->integer('idRecipientes')->unsigned();
            $table->foreign('idRecipientes')->references('Recipientes')->on('id');
            $table->string('observacao')->nullable();
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
        Schema::dropIfExists('mudas');
    }
}

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
            $table->double('custoProducao',10,2)->nullable();
            $table->string('blocoPlantio');
            $table->string('canteiroPlantio');
            $table->string('estagioMuda');
            $table->string('tipoPlantio')->nullable();
            $table->double('taxaPerda')->nullable();
            $table->date('dataAtualizacao')->nullable();
            $table->integer('idSubstratos')->unsigned()->nullable();
            $table->foreign('idSubstratos')->references('id')->on('substratos')->onDelete('restrict');
            $table->integer('idSementes')->unsigned()->nullable();
            $table->foreign('idSementes')->references('id')->on('sementes')->onDelete('restrict');
            $table->integer('idRecipientes')->unsigned()->nullable();
            $table->foreign('idRecipientes')->references('id')->on('recipientes')->onDelete('restrict');
            $table->double('volume_Subs_Recip',10,2)->nullable();
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
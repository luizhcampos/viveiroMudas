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
            $table->double('precoBercario',10,2)->nullable();
            $table->double('precoRustificacao',10,2)->nullable();
            $table->double('precoAltoPadrao',10,2)->nullable();
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

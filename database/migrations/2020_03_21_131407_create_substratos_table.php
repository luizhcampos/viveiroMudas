<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubstratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substratos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('composto');
            $table->double('quant', 10,2);
            $table->string('observacao')->nullable();
            $table->date('inicioMaturacao')->nullable();
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
        Schema::dropIfExists('substratos');
    }
}

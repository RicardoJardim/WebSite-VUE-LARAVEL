<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistoEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registo_equipamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proposta_id')->unsigned();
            $table->json('item');
            $table->timestamps();

            $table->foreign('proposta_id')->references('id')->on('propostas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registo_equipamentos');
    }
}

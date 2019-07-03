<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('profissional_id')->unsigned();
            $table->integer('proposta_id')->unsigned();
            $table->integer('avaliacao');
            $table->text('descricao');
            $table->string('avaliado');
            $table->timestamps();

            $table->foreign('profissional_id')->references('id')->on('user_profissionals');
            $table->foreign('proposta_id')->references('id')->on('propostas');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacaos');
    }
}

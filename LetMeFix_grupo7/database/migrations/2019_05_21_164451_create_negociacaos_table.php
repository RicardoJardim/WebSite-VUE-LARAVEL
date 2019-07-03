<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proposta_id')->unsigned()->nullable(); //TODO : APAGAR
            $table->integer('conversa_id')->unsigned();
            $table->integer('profissional_id')->unsigned();
            $table->string('titulo');
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_final');
            $table->integer('custo');
            $table->boolean('aceite')->nullable();
            $table->timestamps();

            $table->foreign('proposta_id')->references('id')->on('propostas');
            $table->foreign('conversa_id')->references('id')->on('conversas')->onDelete('cascade');
            $table->foreign('profissional_id')->references('id')->on('user_profissionals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negociacaos');
    }
}

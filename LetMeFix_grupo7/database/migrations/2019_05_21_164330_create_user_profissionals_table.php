<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfissionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profissionals', function (Blueprint $table) {
            $table->increments('id');   
            $table->integer('user_id')->unsigned();
            $table->string('morada');
            $table->string('nmr_telefone');
            $table->string('NIF');
            $table->integer('avaliacao')->nullable();
            $table->decimal('nmr_avaliacoes')->default(0);
            $table->integer('preco_hora');
            $table->text('descricao');
            $table->enum('especialidade', ['eletricidade', 'construcao', 'canalizacao', 'carpintaria']);
            $table->json('equipamento'); //TODO: inserir equipamento numa tabela separada
            $table->timestamps();
            $table->string('cor');

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
        Schema::dropIfExists('user_profissionals');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('especialidade', ['eletricidade', 'construcao', 'canalizacao', 'carpintaria']);
            $table->date('data_fim_proposta');
            $table->text('descricao');
            $table->text('morada');
            $table->date('data_inicio')->nullable();
            $table->date('data_final')->nullable();
            $table->integer('custo_inicial')->nullable();
            $table->integer('custo_final')->nullable();
            $table->enum('estado', ['pendente', 'execucao', 'finalizada', 'arquivada'])->default('pendente');
            $table->boolean('profissional')->default(false);
            $table->boolean('user')->default(false);
            $table->boolean('horas')->default(false);
            $table->boolean('equipamento')->default(false);
            $table->boolean('avaliar')->default(false);
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
        Schema::dropIfExists('propostas');
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Proposta;

class PropostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proposta::create([
            'especialidade' => 'eletricidade',
            'data_fim_proposta' => '2019-04-18',
            'descricao' => 'necessita para obra',
            'morada' => 'na minha casa'
        ]);

        Proposta::create([
            'especialidade' => 'construcao',
            'data_fim_proposta' => '2019-04-18',
            'descricao' => 'necessita para obra',
            'morada' => 'na minha casa'
        ]);

        Proposta::create([
            'especialidade' => 'canalizacao',
            'data_fim_proposta' => '2019-04-18',
            'descricao' => 'necessita para obra',
            'morada' => 'na minha casa'
        ]);

        Proposta::create([
            'especialidade' => 'carpintaria',
            'data_fim_proposta' => '2019-04-18',
            'descricao' => 'necessita para obra',
            'morada' => 'na minha casa'
        ]);
    }
}

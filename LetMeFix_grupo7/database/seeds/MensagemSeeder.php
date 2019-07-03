<?php

use Illuminate\Database\Seeder;
use App\Mensagem;

class MensagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mensagem::create([
            'user_id' => '1',
            'conversa_id' => '1',
            'body' => 'Olá!'
        ]);

        Mensagem::create([
            'user_id' => '4',
            'conversa_id' => '1',
            'body' => 'Oi!'
        ]);

        Mensagem::create([
            'user_id' => '1',
            'conversa_id' => '1',
            'body' => 'Tudo bem?'
        ]);

        Mensagem::create([
            'user_id' => '4',
            'conversa_id' => '1',
            'body' => 'Tudo e contigo?'
        ]);
    }
}

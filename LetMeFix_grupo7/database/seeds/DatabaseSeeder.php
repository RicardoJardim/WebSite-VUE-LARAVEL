<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Conversa;
use App\ConversaHasUser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'nome' => 'Admin',
            'tipo' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 2
        ]);
        /*
        User::create([
            'email' => 'user@user.com',
            'nome' => 'Pedro',
            'password' => Hash::make('secret'),
            'tipo' => 'privado',
            'role' => 1
        ]);

        User::create([
            'email' => 'user2@user2.com',
            'nome' => 'Ruben',
            'password' => Hash::make('secret'),
            'tipo' => 'privado',
            'role' => 1
        ]);

        

        User::create([
            'email' => 'user3@user3.com',
            'nome' => 'Jorge',
            'password' => Hash::make('secret'),
            'tipo' => 'profissional',
            'role' => 1
        ]);

        

        $this->call([
        PropostaSeeder::class
        
        ]);

        

        Conversa::create([
            'proposta_id' => 1
        ]);

        ConversaHasUser::create([
            'user_id' => 1,
            'conversa_id'=> 1
        ]);

        ConversaHasUser::create([
            'user_id' => 4,
            'conversa_id' => 1
        ]);

        $this->call([
        MensagemSeeder::class
        
        ]);
        
        // $this->call(UsersTableSeeder::class);*/
    }
}

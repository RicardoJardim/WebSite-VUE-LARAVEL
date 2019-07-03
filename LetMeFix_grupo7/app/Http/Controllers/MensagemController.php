<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Events\MensagemCriada;
use App\Mensagem;
use App\Conversa;
use App\User;

class MensagemController extends Controller
{
    public function index($conversa)
    {
        $mensagens = Mensagem::with('User')->where('conversa_id', $conversa)->get();

        return response()->json(
            [
            	'status' => 'success',
                'mensagens' => $mensagens->toArray()
            ], 200);
    }

    public function show()
    {
        $me = User::getSelf();
        $conversas = Conversa::getConversas()->with('Conversa');

        

        return response()->json(
            [
                'status' => 'success',
                'conversas' => $conversas->toArray()
            ], 200);
    }

    public function store(Request $request)
    {
        $me = User::getSelf();
        $mensagem = new Request([
            'body' => $request->body,
            'conversa_id' => $request->conversa_id,
            'user_id' => $me
        ]);
        Mensagem::create($mensagem->toArray());

        broadcast(new MensagemCriada($mensagem))
                ->toOthers();

        return response()->json($mensagem);
    }
}

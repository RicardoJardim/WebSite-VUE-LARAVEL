<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Negociacao;
use App\User;
use App\UserProfissional;

class NegociacaoController extends Controller
{
    public function index($conversa)
    {
        $negociacoes = Negociacao::getNegociacao($conversa);

        //return response()->json($mensagens);

        return response()->json(
            [
            	'status' => 'success',
                'negociacoes' => $negociacoes->toArray()
            ], 200);
    }

    public function store(Request $request)
    {
        $me = User::getSelf();
        $profissional = UserProfissional::query()->where('user_id', $me)->value('id');

        $v = Validator::make($request->all(), [
            'titulo' => 'required',
            'data_inicio' => 'required',
            'data_final'  => 'required',
            'custo' => 'required|integer',
            'descricao' => 'required|max:150',
            'conversa_id' => 'required'
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'negociacao_error',
                'errors' => $v->errors()
            ], 422);
        }

        $negociacao = new Request([
            'titulo' => $request->titulo,
            'data_inicio' => $request->data_inicio,
            'data_final' => $request->data_final,
            'custo' => $request->custo,
            'descricao' => $request->descricao,
            'conversa_id' => $request->conversa_id,
            'profissional_id' => $profissional,

        ]);

        Negociacao::create($negociacao->toArray());
        

        return response()->json(['status' => 'success'], 200);
    }

}

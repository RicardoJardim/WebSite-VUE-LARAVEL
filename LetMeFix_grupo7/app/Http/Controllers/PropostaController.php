<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Proposta;
use App\PropostaHasUser;
use App\User;
use App\Negociacao;
use App\Conversa;
use App\UserProfissional;
use App\ConversaHasUser;

class PropostaController extends Controller
{
    public function index()
    {
        $propostas = Proposta::query()->where('estado', 'finalizada')->get();

        return response()->json(
            [
                'status' => 'success',
                'propostas' => $propostas->toArray()
            ], 200);
    }

    public function indexFinalizadas()
    {
        $me = User::getSelf();
        $user = User::find($me);

        if ($user->tipo == 'profissional') 
        {
            $profissional_id = UserProfissional::getSelf($me);
            $return = [];
            $propostas_id = PropostaHasUser::query()->where('profissional_id', $profissional_id)->get(['proposta_id'])->toArray();
            $count = count($propostas_id);

            for ($i = 0; $i <= $count - 1; $i++) {
                $proposta = Proposta::query()->where('id', $propostas_id[$i])->where('estado','finalizada')->get()->toArray();
                $p = Proposta::query()->where('id', $propostas_id[$i])->where('estado','finalizada')->get();

                $prop = $p->first();

                $return = array_merge($return, $proposta);            
            }

            return response()->json(
            [
                'status' => 'success',
                'propostas' => $return
            ], 200);
        }
        else
        {
            $return = [];
            $propostas_id = PropostaHasUser::query()->where('user_id', $me)->get(['proposta_id'])->toArray();

            $count = count($propostas_id);

            for ($i = 0; $i <= $count - 1; $i++) {
                $proposta = Proposta::query()->where('id', $propostas_id[$i])->where('estado','finalizada')->get()->toArray();
                $p = Proposta::query()->where('id', $propostas_id[$i])->where('estado','finalizada')->get();

                $prop = $p->first();

                $return = array_merge($return, $proposta);            
            }

            return response()->json(
            [
                'status' => 'success',
                'propostas' => $return
            ], 200);
        }
    }

    public function show(Request $request, $id)
    {
        $proposta = Proposta::find($id);

        return response()->json(
            [
                'status' => 'success',
                'proposta' => $proposta->toArray()
            ], 200);
    }

    public function showSpecific(Request $request, $tipo)
    {
        $propostas = Proposta::type($tipo);

        return response()->json(
            [
                'status' => 'success',
                'propostas' => $propostas->toArray()
            ], 200);
    }

    public function store(Request $request)
    {
        $me = User::getSelf();

        $v = Validator::make($request->all(), [
            'especialidade' => 'required',
            'data_fim_proposta' => 'required',
            'descricao'  => 'required',
            'morada' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'proposta_error',
                'errors' => $v->errors()
            ], 422);
        }

        $proposta = new Request([
            'especialidade' => $request->especialidade,
            'data_fim_proposta' => $request->data_fim_proposta,
            'descricao' => $request->descricao,
            'morada' => $request->morada,

        ]);

        $create = Proposta::create($proposta->toArray());

        

        $propostahasuser = new Request([
            'user_id' => $me,
            'proposta_id' => $create->id,
        ]);

        PropostaHasUser::create($propostahasuser->toArray());
        

        return response()->json(['status' => 'success'], 200);
    }

    public function update($negociacao_id)
    {
        $me = User::getSelf();
        $user = User::find($me);
        
        if ($user->tipo == 'profissional') {
            return response()->json(['status' => 'fail'], 422);
        }
        else
        {
            $negociacao = Negociacao::query()->find($negociacao_id);
            $conversa_id = Negociacao::query()->where('id', $negociacao_id)->value('conversa_id');

            $user_id = ConversaHasUser::query()->where('conversa_id', $conversa_id)->where('user_id', '!=', $me)->value('user_id');
            $profissional = UserProfissional::query()->where('user_id', $user_id)->value('id');

            $proposta_id = Conversa::query()->where('id', $conversa_id)->value('proposta_id');
            $proposta = Proposta::query()->find($proposta_id);
            $propostahasuser_id = PropostaHasUser::query()->where('proposta_id', $proposta_id)->value('id');
            $propostahasuser = PropostaHasUser::query()->find($propostahasuser_id);

            if ($proposta->estado == 'pendente') 
            {
                $proposta->custo_inicial = $negociacao->custo;
                $proposta->estado = 'execucao';
                $proposta->data_inicio = $negociacao->data_inicio;
                $proposta->data_final = $negociacao->data_final;
                
                $proposta->save();

                $propostahasuser->profissional_id = $profissional;

                $propostahasuser->save();

                return response()->json(['status' => 'success'], 200);
            }
            
            return response()->json(['status' => 'fail'], 422);
        }
        
    }

    public function endProposta($proposta_id)
    {
        $me = User::getSelf();
        $user = User::find($me);
        $proposta = Proposta::find($proposta_id);

        if ($proposta->horas == true and $proposta->equipamento == true) 
        {
            if ($user->tipo == 'profissional') 
            {
                if ($proposta->profissional == false) 
                {
                    $proposta->profissional = 1;

                    if ($proposta->user == true) 
                    {
                        $proposta->estado = 'finalizada';
                        $proposta->save();

                        return response()->json(['status' => 'success'], 200);
                    }

                    $proposta->save();
                    return response()->json(['status' => 'success'], 200);
                }
                return response()->json(['status' => 'Profissional already finished'], 422);
            }
            else if ($user->tipo == 'privado' or $user->tipo == 'comercial') 
            {
                if ($proposta->user == false) 
                {
                    $proposta->user = 1;

                    if ($proposta->profissional == true) 
                    {
                        $proposta->estado = 'finalizada';
                        $proposta->save();

                        $conversa_id = Conversa::query()->where('proposta_id', $proposta_id)->value('id');
                        $conversa = Conversa::find($conversa_id);
                        $conversa->delete();

                        return response()->json(['status' => 'success'], 200);
                    }

                    $proposta->save();

                    return response()->json(['status' => 'success'], 200);
                }
                return response()->json(['status' => 'Client already finished'], 422);
            }
        }
    }
}

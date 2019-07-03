<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avaliacao;
use App\User;
use App\PropostaHasUser;
use App\UserProfissional;
use App\UserPrivado;
use App\UserComercial;

class AvaliacaoController extends Controller
{
	//TODO: TESTAR ESTES MÉTODOS
    public function index($id)
    {
        $user = User::find($id);

        if ($user->tipo == 'profissional') 
        {
            $profissional_id = UserProfissional::getSelf($id);

            $avaliacoes = Avaliacao::query()->where('profissional_id', $profissional_id)->where('avaliado', 'profissional')->with('User')->with('Proposta')->get();

            return response()->json(
            [
                'status' => 'success',
                'avaliacoes' => $avaliacoes
            ], 200);
        }
        else
        {
            $avaliacoes = Avaliacao::query()->where('user_id', $id)->where('avaliado', 'user')->with(['Profissional' => function($q){
				$q->with('User');
			}])->with('Proposta')->get();

            return response()->json(
            [
                'status' => 'success',
                'avaliacoes' => $avaliacoes
            ], 200);
        }
    }

    public function store(Request $request, $proposta_id)
    {
    	$me = User::getSelf();
        $user = User::find($me);

        if ($user->tipo == 'profissional') 
        {
            $profissional_id = UserProfissional::getSelf($me);
            $user_id = PropostaHasUser::query()->where('proposta_id', $proposta_id)->value('user_id');

            $avaliacao = new Request([
            'descricao' => $request->descricao,
            'avaliacao' => $request->avaliacao,
            'proposta_id' => $proposta_id,
            'user_id' => $user_id,
            'profissional_id' => $profissional_id,
            'avaliado' => 'user',
	        ]);

	        $count = Avaliacao::query()->where('user_id', $user_id)->where('profissional_id', $profissional_id)->where('proposta_id', $proposta_id)->where('avaliado', 'user')->count();

	        if ($count == 0) {
	        	Avaliacao::create($avaliacao->toArray());

	        	$aux = User::find($user_id);

	        	if ($aux->tipo == 'privado') 
	        	{
	        		$privado_id = UserPrivado::where('user_id', $user_id)->value('id');
	        		$privado = UserPrivado::find($privado_id);

	        		$privado->nmr_avaliacoes = $privado->nmr_avaliacoes + 1;
	        		$privado->save();

	        		if ($privado->nmr_avaliacoes == 1) 
	        		{
	        			$privado->avaliacao = $request->avaliacao;
	        			$privado->save();
	        		}
	        		else
	        		{
	        			$privado->avaliacao = $privado->avaliacao + (($request->avaliacao - $privado->avaliacao)/$privado->nmr_avaliacoes);
	        			$privado->save();
	        		}
	        	}
	        	else if ($aux->tipo == 'comercial') 
	        	{
	        		$comercial_id = UserComercial::where('user_id', $user_id)->value('id');
	        		$comercial = UserComercial::find($comercial_id);

	        		$comercial->nmr_avaliacoes = $comercial->nmr_avaliacoes + 1;
	        		$comercial->save();

	        		if ($comercial->nmr_avaliacoes == 1) 
	        		{
	        			$comercial->avaliacao = $request->avaliacao;
	        			$comercial->save();
	        		}
	        		else
	        		{
	        			$comercial->avaliacao = $comercial->avaliacao + (($request->avaliacao - $comercial->avaliacao)/$comercial->nmr_avaliacoes);
	        			$comercial->save();
	        		}
	        	}

	        	
	        	return response()->json(['status' => 'success'], 200);
	        }

	        return response()->json(['status' => 'Avaliação repetida'], 422);
        }
        else
        {
            $profissional_id = PropostaHasUser::query()->where('proposta_id', $proposta_id)->value('profissional_id');
            $user_id = PropostaHasUser::query()->where('proposta_id', $proposta_id)->value('user_id');

            $avaliacao = new Request([
            'descricao' => $request->descricao,
            'avaliacao' => $request->avaliacao,
            'proposta_id' => $proposta_id,
            'user_id' => $me,
            'profissional_id' => $profissional_id,
            'avaliado' => 'profissional',
	        ]);

	        $count = Avaliacao::query()->where('user_id', $user_id)->where('profissional_id', $profissional_id)->where('proposta_id', $proposta_id)->where('avaliado', 'profissional')->count();

	        if ($count == 0) {
	        	Avaliacao::create($avaliacao->toArray());
	        	
	        	$profissional = UserProfissional::find($profissional_id);

        		$profissional->nmr_avaliacoes = $profissional->nmr_avaliacoes + 1;
        		$profissional->save();

        		if ($profissional->nmr_avaliacoes == 1) 
        		{
        			$profissional->avaliacao = $request->avaliacao;
        			$profissional->save();
        		}
        		else
        		{
        			$profissional->avaliacao = $profissional->avaliacao + (($request->avaliacao - $profissional->avaliacao)/$profissional->nmr_avaliacoes);
        			$profissional->save();
        		}

	        
	        	return response()->json(['status' => 'success'], 200);
	        }

	        return response()->json(['status' => 'Avaliação repetida'], 422);
        }              
    }
}

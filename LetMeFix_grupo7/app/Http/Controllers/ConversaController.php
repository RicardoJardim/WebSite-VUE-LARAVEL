<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversa;
use App\Mensagem;
use App\User;
use App\ConversaHasUser;
use App\PropostaHasUser;

class ConversaController extends Controller
{
    public function index()
    {
        $me = Conversa::getSelfConversa();
        $conversas = Conversa::where('user_id', $me)->orWhere('user2_id', $me)->with('User')->get();

        return response()->json(
        [
            'status' => 'success',
            'conversas' => $conversas->toArray()
        ], 200);
    }

    public function store($proposta_id)
    {
        $me = User::getSelf();
        $user = User::find($me);
        
        if ($user->tipo == 'profissional') 
        {
            //GET PROPOSTA; GET CONVERSA; CHECK CONVERSAHASUSER ALREADY EXISTS
            $conversa_id = Conversa::query()->where('proposta_id', $proposta_id)->value('id');
            $conversa_has_user = ConversaHasUser::query()->where('user_id', $me)->where('conversa_id', $conversa_id)->count();

            if ($conversa_has_user == 0) {
                //CRIAR CONVERSA
                //GET PROPOSTA CREATOR; CREATE CONVERSA; CREATE CONVERSAHASUSER

                $proposta_user_id = PropostaHasUser::query()->where('proposta_id', $proposta_id)->value('user_id');

                $new_conversa = new Request([
                    'proposta_id' => $proposta_id,
                ]);

                $conversa = Conversa::create($new_conversa->toArray());

                $new_conversa_has_user1 = new Request([
                    'conversa_id' => $conversa->id,
                    'user_id' => $proposta_user_id,
                ]);

                $new_conversa_has_user2 = new Request([
                    'conversa_id' => $conversa->id,
                    'user_id' => $me,
                ]);

                ConversaHasUser::create($new_conversa_has_user1->toArray());
                ConversaHasUser::create($new_conversa_has_user2->toArray());

                return response()->json(['status' => 'success'], 200);
            }
            return response()->json(['status' => 'Conversa: Conversa already exists'], 200);
        }
        else
        {
            return response()->json(['status' => 'Fail: Not profissional'], 200);
        }
    }
}

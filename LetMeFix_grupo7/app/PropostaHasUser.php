<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserProfissional;
use App\Proposta;
use Auth;
use Carbon\Carbon;

class PropostaHasUser extends Model
{
	protected $fillable = [
        'user_id', 'proposta_id',
    ];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function proposta()
    {
        return $this->belongsTo('App\Proposta');
    }

    public function profissional()
    {
        return $this->belongsTo('App\UserProfissional');
    }

    public static function getPropostaPendente()
	{
		$me = User::getSelf();
		$tipo = User::getSelfType($me);

		if ($tipo == 'privado' || $tipo == 'comercial') 
		{
			return self::query()->where('user_id', $me)->with(['User'])->with(['Proposta' => function($q){
				$q->where('estado', 'pendente')->where('data_fim_proposta', '>=', Carbon::now());
			}])->get()->toArray();
		}
		else if ($tipo == 'profissional') 
		{
			$profissional = UserProfissional::getSelf($me);
			$especialidade = UserProfissional::getSelfEspecialidade($profissional);

			$propostas = [];
			$id = Proposta::type($especialidade);
			$count = count($id);

			for ($i = 0; $i <= $count - 1; $i++) {
		    	$proposta = self::query()->where('proposta_id', $id[$i])->with('User')->with(['Proposta' => function($q){
		    		$q->where('estado','pendente')->where('data_fim_proposta', '>=', Carbon::now());
		    	}])->get()->toArray();

		    	$p = self::query()->where('proposta_id', $id[$i])->with('User')->with(['Proposta' => function($q){
		    		$q->where('estado','pendente')->where('data_fim_proposta', '>=', Carbon::now());
		    	}])->get();

		    	$prop = $p->first();


		    	if (!is_null($prop->proposta)) {
		    		$propostas = array_merge($propostas, $proposta);	    	
		    	}
	    	
			}

			return $propostas;
		}
	    
	}

	public static function getPropostaExecucao()
	{
		//dd(Auth::check());
		$me = User::getSelf();
		$tipo = User::getSelfType($me);

		if ($tipo == 'privado' || $tipo == 'comercial') 
		{
			return self::query()->where('user_id', $me)->with(['User'])->with(['Proposta' => function($q){
				$q->where('estado', 'execucao');
			}])->get()->toArray();
		}
		else if ($tipo == 'profissional') 
		{
			$profissional = UserProfissional::getSelf($me);
			$especialidade = UserProfissional::getSelfEspecialidade($profissional);

			return self::query()->where('profissional_id', $profissional)->with(['User'])->with(['Proposta' => function($q){
				$q->where('estado', 'execucao');
			}])->get()->toArray();
		}
	    
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistoHora;
use App\Proposta;
use DateTime;

class RegistoHoraController extends Controller
{
    public function index($proposta_id)
    {
        $horas = RegistoHora::query()->where('proposta_id', $proposta_id)->orderBy('dia', 'ASC')->get();

        return response()->json(
            [
            	'status' => 'success',
                'hora' => $horas->toArray()
            ], 200);
    }

    public function store(Request $request, $proposta_id)
    {
    	//CHECK IF DATA REPETIDA; INSERT REGISTO HORA
    	$horas = RegistoHora::query()->where('proposta_id', $proposta_id)->where('dia', $request->dia)->count();

    	if ($horas == 0) 
    	{
    		$hora = new Request([
    			'proposta_id' => $proposta_id,
    			'justificacao' => $request->justificacao,
    			'dia' => $request->dia,
    		]);

    		RegistoHora::create($hora->toArray());

            $count = RegistoHora::query()->where('proposta_id', $proposta_id)->count();
            $proposta = Proposta::find($proposta_id);

            $fdate = $proposta->data_inicio;
            $tdate = $proposta->data_final;
            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            
            if ($count == $days + 1 and $proposta->horas == false) 
            {
                $proposta->horas = true;
                $proposta->save();

                if ($proposta->equipamento == true and $proposta->horas == true) 
                {
                $proposta->avaliar = true;
                $proposta->save();
                }
            }

    		return response()->json(['status' => 'success'], 200);
    	}   		

		return response()->json(['status' => 'fail'], 422);              
    }
}

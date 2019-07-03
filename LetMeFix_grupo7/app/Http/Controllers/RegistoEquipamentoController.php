<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistoEquipamento;
use App\Proposta;

class RegistoEquipamentoController extends Controller
{
    public function index($proposta_id)
    {
        $equipamentos = RegistoEquipamento::query()->where('proposta_id', $proposta_id)->first();

        return response()->json(
            [
            	'status' => 'success',
                'equipamento' => $equipamentos->toArray()
            ], 200);
    }

    public function store(Request $request, $proposta_id)
    {
    	//CHECK EQUIPAMENTOS NA PROPOSTA; ADD/PUSH EQUIPAMENTOS
    	$equipamentos = RegistoEquipamento::query()->where('proposta_id', $proposta_id)->count();

        $proposta = Proposta::find($proposta_id);

    	if ($equipamentos == 0) 
    	{
    		$equipamento = new Request([
    			'proposta_id' => $proposta_id,
    			'item' => $request->equipamento,
    		]);

    		RegistoEquipamento::create($equipamento->toArray());

            $proposta->equipamento = 1;
            $proposta->save();

            if ($proposta->equipamento == true and $proposta->horas == true) {
                $proposta->avaliar = true;
                $proposta->save();
            }

    		return response()->json(['status' => 'success'], 200);
    	}
    	else
    	{
    		$equipamento_id = RegistoEquipamento::query()->where('proposta_id', $proposta_id)->value('id');

    		$registo_equipamento = RegistoEquipamento::find($equipamento_id);

    		$teste = $registo_equipamento->item;

    		for ($i=0; $i <= sizeof($request->equipamento) - 1 ; $i++) { 
    			$string = $request->equipamento[$i];
    			array_push($teste, $string);
    		}

			$registo_equipamento->item = $teste;
    		$registo_equipamento->save();

            $proposta->equipamento = 1;
            $proposta->save();

            if ($proposta->equipamento == true and $proposta->horas == true) {
                $proposta->avaliar = true;
                $proposta->save();
            }
    		

    		return response()->json(['status' => 'success'], 200);
    	}              
    }
}

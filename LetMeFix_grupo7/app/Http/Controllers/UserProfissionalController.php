<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\UserProfissional;

class UserProfissionalController extends Controller
{
    public function index()
    {
        $profissionais = UserProfissional::getProfissional();

        return response()->json(
            [
                'status' => 'success',
                "profissionais" => $profissionais->toArray(),
            ], 200);
    }

    public function area()
    {
        $eletricidade = UserProfissional::getEletricidade();
        $contrucao = UserProfissional::getConstrucao();
        $canalizacao = UserProfissional::getCanalizacao();
        $carpintaria = UserProfissional::getCarpintaria();

        return response()->json(
            [
                'status' => 'success',
                "profissionais" => [
					        'eletricidade' => $eletricidade->toArray(),
					        'contrucao' => $contrucao->toArray(),
					        'canalizacao' => $canalizacao->toArray(),
					        'carpintaria' => $carpintaria->toArray(),
					    ]
            ], 200);
    }
}

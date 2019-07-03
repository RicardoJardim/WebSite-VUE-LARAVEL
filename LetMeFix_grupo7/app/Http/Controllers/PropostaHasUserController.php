<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropostaHasUser;

class PropostaHasUserController extends Controller
{
    public function index()
    {
        return $propostas = PropostaHasUser::getPropostaPendente();

        return response()->json(
            [
                'status' => 'success',
                'propostas' => $propostas
            ], 200);
    }

    public function indexExecucao()
    {
        return $propostas = PropostaHasUser::getPropostaExecucao();

        return response()->json(
            [
                'status' => 'success',
                'propostas' => $propostas
            ], 200);
    }
}

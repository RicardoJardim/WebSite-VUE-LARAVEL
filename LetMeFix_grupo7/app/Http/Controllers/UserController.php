<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfissional;
use App\UserComercial;
use App\UserPrivado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user->tipo == 'profissional') 
        {
            $perfil = UserProfissional::perfil($id);

            return response()->json(
            [
                'status' => 'success',
                'user' => $perfil->toArray()
            ], 200);
        }   
        else if ($user->tipo == 'comercial') 
        {
            $perfil = UserComercial::perfil($id);

            return response()->json(
            [
                'status' => 'success',
                'user' => $perfil->toArray()
            ], 200);
        }
        else if ($user->tipo == 'privado') 
        {
            $perfil = UserPrivado::perfil($id);

            return response()->json(
            [
                'status' => 'success',
                'user' => $perfil->toArray()
            ], 200);
        }
    }

    public function me()
    {
        $user = User::me();

        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }

    public function store(Request $request)
    {

        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'negociacao_error',
                'errors' => $v->errors()
            ], 422);
        }

        $funcionario = new Request([
            'email' => $request->email,
            'nome' => 'Funcionário',
            'tipo' => 'funcionario',
            'password' => bcrypt($request->password),
        ]);

        User::create($funcionario->toArray());
        

        return response()->json(['status' => 'success'], 200);
    }

    public function suspend($user_id)
    {
        $user = User::find($user_id);

        if ($user->suspend == true) 
        {
            $user->suspend = false;
            $user->save();
        }
        else if ($user->suspend == false)
        {
            $user->suspend = true;
            $user->save();
        }

        return response()->json(['status' => 'success'], 200);
    }
}

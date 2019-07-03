<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfissional;
use App\UserComercial;
use App\UserPrivado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{

    public function register(Request $request)
    {  
        if ($request->tipo == 'privado') 
        {
                $v = Validator::make($request->all(), [
                'morada' => 'required',
                'NIF' => 'required',
                'nmr_telefone' => 'required|max:9|min:9',
                'email' => 'required|email|unique:users',
                'nome' => 'required',
                'password'  => 'required|min:3|confirmed',
            ]);

            if ($v->fails())
            {
                return response()->json([
                    'status' => 'error',
                    'errors' => $v->errors()
                ], 422);
            }

            $user = new User;
            $user->tipo = 'privado';
            $user->email = $request->email;
            $user->nome = $request->nome;
            $user->password = bcrypt($request->password);
            $user->save();

            $userPrivado = new userPrivado;
            $userPrivado->NIF = $request->NIF;
            $userPrivado->morada = $request->morada;
            $userPrivado->nmr_telefone = $request->nmr_telefone;
            $userPrivado->user_id = $user->id;
            $userPrivado->save();

            return response()->json(['status' => 'success'], 200);
        }
        else if ($request->tipo == 'comercial') 
        {
                $v = Validator::make($request->all(), [
                'morada' => 'required',
                'NIF' => 'required',
                'nmr_telefone' => 'required|max:9|min:9',
                'email' => 'required|email|unique:users',
                'nome' => 'required',
                'ramo' => 'required',
                'password'  => 'required|min:3|confirmed',
            ]);

            if ($v->fails())
            {
                return response()->json([
                    'status' => 'error',
                    'errors' => $v->errors()
                ], 422);
            }

            $user = new User;
            $user->tipo = 'comercial';
            $user->email = $request->email;
            $user->nome = $request->nome;
            $user->password = bcrypt($request->password);
            $user->save();

            $userComercial = new UserComercial;
            $userComercial->NIF = $request->NIF;
            $userComercial->ramo = $request->ramo;
            $userComercial->morada = $request->morada;
            $userComercial->nmr_telefone = $request->nmr_telefone;
            $userComercial->user_id = $user->id;
            $userComercial->save();

            return response()->json(['status' => 'success'], 200);
        }

        else if ($request->tipo == 'profissional') 
        {
                $v = Validator::make($request->all(), [
                'morada' => 'required',
                'NIF' => 'required',
                'nmr_telefone' => 'required|max:9|min:9',
                'email' => 'required|email|unique:users',
                'nome' => 'required',
                'especialidade' => 'required',
                'preco_hora' => 'required',
                'descricao' => 'required|max:150',
                'password'  => 'required|min:3|confirmed',
            ]);

            if ($v->fails())
            {
                return response()->json([
                    'status' => 'error',
                    'errors' => $v->errors()
                ], 422);
            }

            $user = new User;
            $user->tipo = 'profissional';
            $user->email = $request->email;
            $user->nome = $request->nome;
            $user->password = bcrypt($request->password);
            $user->save();

            $userProfissional = new UserProfissional;
            $userProfissional->NIF = $request->NIF;
            $userProfissional->especialidade = $request->especialidade;
            $userProfissional->preco_hora = $request->preco_hora;
            $userProfissional->equipamento = $request->equipamento;
            $userProfissional->descricao = $request->descricao;
            if ($request->especialidade == 'eletricidade') {
                $userProfissional->cor = 'yellow-card';
            }
            else if ($request->especialidade == 'construcao') {
                $userProfissional->cor = 'brown-card';
            }
            else if ($request->especialidade == 'canalizacao') {
                $userProfissional->cor = 'blue-card';
            }
            else if ($request->especialidade == 'carpintaria') {
                $userProfissional->cor = 'orange-card';
            }            
            $userProfissional->morada = $request->morada;
            $userProfissional->nmr_telefone = $request->nmr_telefone;
            $userProfissional->user_id = $user->id;
            $userProfissional->save();

            return response()->json(['status' => 'success'], 200);
        }
        
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) 
        {
            $me = User::getSelf();
            $user = User::find($me);
            if ($user->suspend == true) 
            {
                Auth::logout();
                return response()->json(['error' => 'login_error'], 401);
            }
        }
        

        if (Auth::attempt($credentials)) 
        {
            if ($token = $this->guard()->attempt($credentials)) 
            {
                return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
            }
        }
       

        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        Auth::logout();
        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}


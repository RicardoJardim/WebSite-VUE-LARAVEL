<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;

use App\UserProfissional;
use App\UserComercial;
use App\UserPrivado;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'password', 'tipo', 'suspend'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function proposta()
    {
        return $this->hasMany('App\Proposta');
    }

    public function avaliacao()
    {
        return $this->hasMany('App\Avaliacao');
    }

    public function profissional()
    {
        return $this->hasMany('App\UserProfissional');
    }

    public function comercial()
    {
        return $this->hasMany('App\UserComercial');
    }

    public function privado()
    {
        return $this->hasMany('App\UserPrivado');
    }

    public function mensagem()
    {
        return $this->hasMany('App\Mensagem');
    }

    public function conversa_has_user()
    {
        return $this->hasMany('App\ConversaHasUser');
    }

    public function proposta_has_user()
    {
        return $this->hasMany('App\PropostaHasUser');
    }

    public static function getSelf()
    {
        //return 2;
        return Auth::id();
        //return $this->user_id === auth()->user()->id;
    }

    public static function getSelfType($id)
    {
        //return "profissional";
        //return 'privado';
        return Auth::user()->tipo;
    }

    public static function getProfissional()
    {
        return self::query()->where('tipo', 'profissional')->get();
    }

    public static function me()
    {
        $me = User::getSelf();
        $user = self::query()->find($me);

        if ($user->tipo == "privado") 
        {
            $privado = UserPrivado::getSelf($me);
            return UserPrivado::query()->with('User')->find($privado);
        }
        else if ($user->tipo == "comercial") 
        {
            $comercial = UserComercial::getSelf($me);
            return UserComercial::query()->with('User')->find($comercial);
        }
        else if ($user->tipo == "profissional") 
        {
            $profissional = UserProfissional::getSelf($me);
            return UserProfissional::query()->with('User')->find($profissional);
        }
    }
}

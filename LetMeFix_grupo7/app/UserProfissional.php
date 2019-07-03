<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfissional extends Model
{
    protected $casts = [
        'equipamento' => 'array'
    ];

    protected $fillable = [
        'morada', 'NIF', 'nmr_telefone', 'user_id', 'avaliacao', 'especialidade', 'preco_hora', 'descricao'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function proposta_has_user()
    {
        return $this->hasMany('App\PropostaHasUser');
    }

    public function negociacao()
    {
        return $this->hasMany('App\Negociacao');
    }

    public function avaliacao()
    {
        return $this->hasMany('App\Avaliacao');
    }

    public static function getSelf($user_id)
    {
        return self::query()->where('user_id', $user_id)->value('id');
    }

    public static function getSelfEspecialidade($profissional_id)
    {
        return self::query()->where('id', $profissional_id)->get(['especialidade'])->toArray();
    }

    public static function getProfissional()
    {
        return self::query()->with('User')->get();
    }
    public static function getEletricidade()
    {
        return self::query()->with('User')->where('especialidade', 'eletricidade')->get();
    }
    public static function getConstrucao()
    {
        return self::query()->with('User')->where('especialidade', 'construcao')->get();
    }
    public static function getCanalizacao()
    {
        return self::query()->with('User')->where('especialidade', 'canalizacao')->get();
    }
    public static function getCarpintaria()
    {
        return self::query()->with('User')->where('especialidade', 'carpintaria')->get();
    }

    public static function perfil($user_id)
    {
        return self::query()->where('user_id', $user_id)->with('User')->first();
    }
}

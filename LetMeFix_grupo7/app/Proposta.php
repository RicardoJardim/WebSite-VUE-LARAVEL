<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    protected $fillable = [
        'especialidade', 'descricao', 'data_fim_proposta', 'morada', 'data_inicio', 'data_final', 'estado', 'equipamento', 'user', 'profissional', 'horas'
    ];

    public function foto()
    {
        return $this->hasMany('App\Foto');
    }

    public function proposta_has_user()
    {
        return $this->hasMany('App\PropostaHasUser');
    }

    public function conversa()
    {
        return $this->hasMany('App\Conversa');
    }

    public function avaliacao()
    {
        return $this->hasMany('App\Avaliacao');
    }

    public static function type($tipo)
    {
        return self::query()->where('especialidade', $tipo)->get(['id'])->toArray();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negociacao extends Model
{
    protected $fillable = ['descricao', 'custo', 'data_inicio', 'data_final', 'proposta_id', 'conversa_id', 'profissional_id', 'titulo'];


    public function profissional()
    {
        return $this->belongsTo('App\UserProfissional');
    }

    public function conversa()
    {
        return $this->belongsTo('App\Conversa');
    }

    public function proposta()
    {
        return $this->belongsTo('App\Proposta');
    }

    public static function getNegociacao($conversa){
    	return self::query()->where('conversa_id', $conversa)->orderBy('id', 'DESC')->get();
    }    
}

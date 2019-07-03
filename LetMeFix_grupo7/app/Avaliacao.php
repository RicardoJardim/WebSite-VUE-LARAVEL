<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
	protected $fillable = [
        'user_id', 'profissional_id', 'proposta_id', 'avaliacao', 'descricao', 'avaliado'
    ];

    public function profissional()
    {
        return $this->belongsTo('App\UserProfissional');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function proposta()
    {
        return $this->belongsTo('App\Proposta');
    }
}

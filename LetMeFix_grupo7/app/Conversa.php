<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversa extends Model
{
    protected $fillable = ['proposta_id'];

    public function mensagem()
    {
        return $this->hasMany('App\Mensagem');
    }

    public function conversa_has_user()
    {
        return $this->hasMany('App\ConversaHasUser');
    }

    public function negociacao()
    {
        return $this->hasMany('App\Negociacao');
    }

    public function proposta()
    {
        return $this->belongsTo('App\Proposta');
    }

	public static function getConversas()
	{
		$me = getSelfConversa();
	    return self::query()->with('User')->where('user_id', $me)->orWhere('user2_id', $me)->get();
	}
}

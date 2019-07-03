<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPrivado extends Model
{
	protected $fillable = [
        'morada', 'NIF', 'nmr_telefone', 'user_id', 'avaliacao'
    ];

    public static function getSelf($user_id)
    {
        return self::query()->where('user_id', $user_id)->value('id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function perfil($user_id)
    {
        return self::query()->where('user_id', $user_id)->with('User')->first();
    }
}

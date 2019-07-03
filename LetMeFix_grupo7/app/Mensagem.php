<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $fillable = ['body', 'user_id', 'conversa_id'];
	protected $appends = ['selfMessage'];


    public function conversa()
    {
        return $this->belongsTo('App\Conversa');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }   

    public static function getSelfMessageAttribute()
	{
	    return 1;
	    //$this->user_id === auth()->user()->id;
	}
}

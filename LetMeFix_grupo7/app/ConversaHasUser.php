<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ConversaHasUser extends Model
{
	protected $fillable = ['user_id', 'conversa_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function conversa()
    {
        return $this->belongsTo('App\Conversa');
    } 

    public static function getConversa()
	{
		$me = User::getSelf();
	    $id = self::query()->where('user_id', $me)->get(['conversa_id'])->toArray();
	    $count = self::query()->where('user_id', $me)->get()->count();
	    $conversas = [];



	    for ($i = 0; $i <= $count - 1; $i++) {
	    	$conversa = self::query()->where('conversa_id', $id[$i])->where('user_id', '!=', $me)->with('User')->get()->toArray();
	    	$conversas = array_merge($conversas, $conversa);
		}
	    
	    return $conversas;
		
	    

	    //TODO: query para conseguir os nomes através dos ids
	    /*$listing = Listing:where('id', $id);
		foreach ($input as $key => $value) {
		     $i++;
		     // ->where('field_1', red_1); // Desired output
		     $listing->where("where(field_{$i},".$value."_1)");
		}
		$results = $listing->get();*/
	}
}

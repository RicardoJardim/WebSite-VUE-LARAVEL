<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    public function proposta()
    {
        return $this->belongsTo('App\Proposta');
    }
}

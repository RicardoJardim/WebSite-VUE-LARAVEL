<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistoHora extends Model
{
    protected $fillable = [
        'dia', 'proposta_id', 'justificacao'
    ];
}

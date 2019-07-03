<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistoEquipamento extends Model
{
    protected $casts = [
        'item' => 'array'
    ];

    protected $fillable = [
        'item', 'proposta_id'
    ];
}

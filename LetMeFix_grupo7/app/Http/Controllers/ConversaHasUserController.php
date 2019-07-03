<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConversaHasUser;

class ConversaHasUserController extends Controller
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function conversa()
    {
        return $this->belongsTo('App\Conversa');
    }

    public function index()
    {
        $conversas = ConversaHasUser::getConversa();

        return response()->json(
            [
                'status' => 'success',
                'conversas' => $conversas
            ], 200);
    }
}

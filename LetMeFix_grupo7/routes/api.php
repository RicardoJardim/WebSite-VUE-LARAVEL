<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});


Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
});

Route::get('me', 'UserController@me');
Route::get('me/finalizadas', 'PropostaController@indexFinalizadas');
Route::get('me/propostas', 'PropostaHasUserController@indexExecucao');
Route::put('me/propostas/end/{proposta_id}', 'PropostaController@endProposta');
Route::get('/me/propostas/equipamento/{proposta_id}', 'RegistoEquipamentoController@index');
Route::post('/me/propostas/equipamento/create/{proposta_id}', 'RegistoEquipamentoController@store');
Route::get('/me/propostas/horas/{proposta_id}', 'RegistoHoraController@index');
Route::post('/me/propostas/horas/create/{proposta_id}', 'RegistoHoraController@store');
Route::post('/me/propostas/avaliacao/create/{proposta_id}', 'AvaliacaoController@store');


Route::get('/profissionais/area', 'UserProfissionalController@area');
Route::get('/profissionais', 'UserProfissionalController@index');

//Route::get('propostas', 'PropostaController@index');
Route::post('proposta/create', 'PropostaController@store');
Route::get('propostas', 'PropostaHasUserController@index');
Route::get('propostas/{id}', 'PropostaController@show');
Route::get('propostas/area/{tipo}', 'PropostaController@showSpecific');
Route::put('propostas/update/{negociacao_id}', 'PropostaController@update');

Route::get('admin/propostas', 'PropostaController@index');
Route::get('admin/users', 'UserController@index');
Route::post('funcionario/create', 'UserController@store');
Route::put('admin/user/suspend/{user_id}', 'UserController@suspend');


Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/mensagem/{conversa}', 'MensagemController@index')->name('mensagem');
Route::get('/conversas', 'ConversaHasUserController@index')->name('conversas');
Route::post('/mensagem', 'MensagemController@store')->name('mensagem.store');
Route::post('/conversa/create/{proposta_id}', 'ConversaController@store');

Route::get('/negociacao/{conversa}', 'NegociacaoController@index')->name('negociacao');
Route::post('negociacao/create', 'NegociacaoController@store');

Route::get('user/{id}', 'UserController@show');
Route::get('avaliacoes/{id}', 'AvaliacaoController@index');
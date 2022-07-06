<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});
Route::get('registarUtilizador', 'UtilizadorController@registarUtilizador');
Route::post('logar', 'UtilizadorController@logar');
Route::get('logout', 'UtilizadorController@logout');


Route::post('registarFuncionario','PessoaController@registarFuncionario');


Route::get('salvarAccao','ConsumirAPIController@salvarAccao');
Route::get('salvarTarefa','ConsumirAPIController@salvarTarefa');
Route::get('pegaTarefas','ConsumirAPIController@pegaTarefas');
Route::get('pegaOperacoes','ConsumirAPIController@pegaOperacoes');

Route::get('listarUtilizadores','ConsumirAPIController@listarUtilizadores');
Route::get('salvarUtilizadornoKA/{username}','ConsumirAPIController@salvarUtilizadornoKA');


Route::get('listarTipos','ConsumirAPIController@listarTipos');
Route::get('salvarTiponoKA','ConsumirAPIController@salvarTiponoKA');

Route::get('listarOrigens','ConsumirAPIController@listarOrigens');
Route::get('salvarOrigemnoKA','ConsumirAPIController@salvarOrigemnoKA');

Route::get('salvarTipoOrigemnoKA','ConsumirAPIController@salvarTipoOrigemnoKA');

Route::get('exportarTarefasParaKA','ConsumirAPIController@exportarTarefasParaKA');

Route::post('importarTarefas','ConsumirAPIController@importarTarefas');

Route::post('registarTeste','ConsumirAPIController@registarTeste');

///////////Rotas Kixiclientes//////////
Route::get('listarClientes','ClienteController@listarClientes');
Route::get('salvarClientes','ClienteController@salvarClientesWeb');
Route::get('exportarClientes','ClienteController@gerarJSONClientes');
Route::get('exportarCabecalhos','ClienteController@gerarJSONCabecalho');









Route::get('testeLOGIN','ConsumirAPIController@testeLOGIN');


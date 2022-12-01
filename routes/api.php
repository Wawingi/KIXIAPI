<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('loginAPI','UtilizadorController@loginAPI');

Route::get('listarProduto','ConsumirAPIController@listarProduto');


////// Faturacao ////
Route::get('listarFaturaAPI', 'FaturaControllerAPI@listarFaturaAPI');
Route::get('getDadosFactura/{codigoFactura}', 'FaturaControllerAPI@getDadosFacturaAPI')->where('codigoFactura', '(.*)');
Route::get('getDadosEmpresa', 'FaturaControllerAPI@getDadosEmpresaAPI');
Route::get('ClienteEspecifico/{cliente}', 'FaturaControllerAPI@ClienteEspecificoAPI');

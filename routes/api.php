<?php

use App\Http\Controllers\Api\CorreiosController;
use App\Http\Controllers\Api\FreeApi;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/rastro', [CorreiosController::class, 'rastreio']);

Route::post('/v1/pagamento/confirma-pix', [FreeApi::class, 'confirmaPix']);

Route::post('/acesso/gerar-token', [FreeApi::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    //aqui oq for necessario login

    Route::get('/v1/pagamento/consulta-pix', [FreeApi::class, 'consultaPix']);
    
});

Route::post('/salvar', [FreeApi::class, 'salvar']);
Route::get('/teste', [FreeApi::class, 'index']);
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

Route::post('/register', 'App\Http\Controllers\ApiController@register');

Route::post('/login', 'App\Http\Controllers\ApiController@login');


Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::apiResource('user','App\Http\Controllers\ApiController')->except('update');
    //api para index
    Route::get('/product', 'App\Http\Controllers\ApiController@getIndex');
    //api para show
    Route::get('/product/{id}', 'App\Http\Controllers\ApiController@getShow');
    //api para store
    Route::post('/product', 'App\Http\Controllers\ApiController@postStore');
    //api para actualizar
    Route::post('/product/{id}', 'App\Http\Controllers\ApiController@postUpdate');
    //api para eliminar
    Route::delete('/product/{id}', 'App\Http\Controllers\ApiController@postDestroy');
});

Route::middleware('auth:sanctum')->post('/user/{id}', 'App\Http\Controllers\ApiController@update');

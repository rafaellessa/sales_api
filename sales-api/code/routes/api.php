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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => '/v1'], function(){

    Route::group(['prefix' => '/seller'], function(){
        Route::get('/', 'SellerController@index');
        Route::post('/','SellerController@store');
    });

    Route::group(['prefix' => '/sale'], function(){
        Route::get('/{id}', 'SaleController@get');
        Route::post('/', 'SaleController@store');

    });
});



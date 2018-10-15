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

Route::post("register","UserController@register");

Route::post("auth","UserController@auth");

Route::post("login","UserController@check");

Route::post("shops","ShopController@fetch");

Route::post("dislike","ShopController@dislike");

Route::post("like","ShopController@like"); 

Route::post("prefered_shops","ShopController@prefered_shops");

Route::post("remove","ShopController@remove");


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
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {

    //NFTS
    Route::get('/nfts/{nft}',  'App\Http\Controllers\NFTController@get');
    Route::get('/nfts', 'App\Http\Controllers\NFTController@getAll');
    Route::post('/nfts', 'App\Http\Controllers\NFTController@create');
    Route::delete('/nfts/{nft}', 'App\Http\Controllers\NFTController@delete');
    Route::put('/nfts/{nft}', 'App\Http\Controllers\NFTController@updateeeee'); //TODO: this one :)

    //User
    Route::get('/users/{user}',  'App\Http\Controllers\UserController@get');
    Route::get('/users', 'App\Http\Controllers\UserController@getAll');
    Route::post('/users', 'App\Http\Controllers\UserController@create');
    Route::delete('/users/{user}', 'App\Http\Controllers\UserController@delete');
    Route::put('/users/{user}', 'App\Http\Controllers\UserController@updateeeee'); //TODO: this one :)

});

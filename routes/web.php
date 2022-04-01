<?php

use App\Http\Controllers\NFTController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtistController;

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
    return view('home');
});

Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store'])->name('user.store');

Route::group(['prefix' => 'api'], function () {

    //## NFTS ##
    //CRUDS
    Route::get('/nfts/{nft}', [NftController::class, 'get']);
    Route::get('/nfts', [NftController::class, 'getAll']);
    Route::get('/nfts/create', [NftController::class, 'create']);
    Route::delete('/nfts/{nft}', [NftController::class, 'delete']);
    Route::put('/nfts/{nft}', [NftController::class, 'update']);

    //Filter depending availability
    Route::post('/nfts/available', [NftController::class, 'available']);

    //## User ##
    //CRUDS
    Route::get('/users/{user}',  [UserController::class, 'get']);
    Route::get('/users', [UserController::class, 'getAll']);
    Route::post('/users', [UserController::class, 'create']);
    Route::delete('/users/{user}', [UserController::class, 'delete']);
    Route::put('/users/{user}', [UserController::class, 'update']);

    //Collection
    Route::get('/collections/{collection}',  [CollectionController::class, 'get']);
    Route::get('/collections', [CollectionController::class, 'getAll']);
    Route::post('/collections', [CollectionController::class, 'create']);
    Route::delete('/collections/{collection}', [CollectionController::class, 'delete']);
    Route::put('/collections/{collection}', [CollectionController::class, 'update']);

    //Type
    Route::get('/types/{type}',  [TypeController::class, 'get']);
    Route::get('/types', [TypeController::class, 'getAll']);
    Route::post('/types', [TypeController::class, 'create']);
    Route::delete('/types/{type}', [TypeController::class, 'delete']);
    Route::put('/types/{type}', [TypeController::class, 'update']);
    
    //Artist
    Route::get('/artists/{artist}', [ArtistController::class, 'get']);
    Route::get('/artists', [ArtistController::class, 'getAll']);
    Route::post('/artists', [ArtistController::class, 'create']);
    Route::delete('/artists/{artist}', [ArtistController::class, 'delete']);
    Route::put('/artists/{artist}', [ArtistController::class, 'update']);

});

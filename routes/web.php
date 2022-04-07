<?php

use App\Http\Controllers\NftController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

// SORT COLLECTIONS
//Order by name
Route::get('/collections/sortByName', [CollectionController::class, 'sortByName']);


// USERS
// Views
Route::get('/users/create', [UserController::class, 'create']);
Route::get('/users/create', [UserController::class, 'create']);
Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
//Sorting for users
Route::get('/users/sortByBalance', [UserController::class, 'sortByBalance']);
Route::get('/users/sortByName', [UserController::class, 'sortByName']);


// NFTS
//Filter depending price
Route::get('/nfts/priceFilter', [NftController::class, 'filterPrice']);
//Filter depending availability
Route::get('/nfts/available', [NftController::class, 'available']);
//Sort depending price
Route::get('/nfts/sortByPrice', [NftController::class, 'sortByPrice']);
//Sort depending exclusivity
Route::get('/nfts/sortByExclusivity', [NftController::class, 'sortByExclusivity']);

//Artists
//Order by name
Route::get('/artists/sortByName', [ArtistController::class, 'sortByName']);
Route::get('/artists/sortByBalance', [ArtistController::class, 'sortByBalance']);
Route::get('/artists/sortByVolume', [ArtistController::class, 'sortByVolume']);

//Types
//Order by name
Route::get('/types/sortByExclusivity', [TypeController::class, 'sortByExclusivity']);




// ###########
// ## CRUDS ##
// ###########

Route::group(['prefix' => 'api'], function () {

    //## NFTS ##
    Route::get('/nfts/{nft}', [NftController::class, 'get'])->name('nft.getOne');
    Route::get('/nfts', [NftController::class, 'getAll'])->name('nft.getAll');
    Route::post('/nfts', [NftController::class, 'store'])->name('nft.store');
    Route::delete('/nfts', [NftController::class, 'delete'])->name('nft.delete');
    Route::put('/nfts', [NftController::class, 'update'])->name('nft.update');

    //## User ##
    Route::get('/users/{user}',  [UserController::class, 'get'])->name('user.getOne');
    Route::get('/users', [UserController::class, 'getAll'])->name('user.getAll');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::delete('/users', [UserController::class, 'delete'])->name('user.delete');
    Route::put('/users', [UserController::class, 'update'])->name('user.update');

    //## Collection ##
    Route::get('/collections/{collection}',  [CollectionController::class, 'get'])->name('collection.getOne');
    Route::get('/collections', [CollectionController::class, 'getAll'])->name('collection.getAll');
    Route::post('/collections', [CollectionController::class, 'store'])->name('collection.store');
    Route::delete('/collections', [CollectionController::class, 'delete'])->name('collection.delete');
    Route::put('/collections', [CollectionController::class, 'update'])->name('collection.update');

    //## Type ##
    Route::get('/types/{type}',  [TypeController::class, 'get'])->name('type.getOne');
    Route::get('/types', [TypeController::class, 'getAll'])->name('type.getAll');
    Route::post('/types', [TypeController::class, 'store'])->name('type.store');
    Route::delete('/types', [TypeController::class, 'delete'])->name('type.delete');
    Route::put('/types', [TypeController::class, 'update'])->name('type.update');

    //## Artist ##
    Route::post('/artists', [ArtistController::class, 'store'])->name('artist.store');
    Route::get('/artists/{artist}', [ArtistController::class, 'get'])->name('artist.getOne');
    Route::get('/artists', [ArtistController::class, 'getAll'])->name('artist.getAll');
    Route::delete('/artists', [ArtistController::class, 'delete'])->name('artist.delete');
    Route::put('/artists', [ArtistController::class, 'update'])->name('artist.update');
});

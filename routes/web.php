<?php

use App\Http\Controllers\NftController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\Logoutcontroller;
use App\Http\Controllers\ImageUploadController;

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

Route::get('/pepe', [NftController::class, 'getExpensive']);

Route::get('/', [NftController::class, 'getHome']);

//Logout
Route::get('/logout', [Logoutcontroller::class, 'perform']);

//Contact
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/profileSettings', function () {
    return view('profileSettings');
});

/* Route::get('/add-nft', function () {
    return view('add-nft');
}); */

//For storing an image
Route::post('/store-image', [ImageUploadController::class, 'storeImage'])
    ->name('images.store');

//COLLECTIONS
//Sort by name
Route::get('/collections/sortByName', [CollectionController::class, 'sortByName']);
Route::put('/collections/sale/{collection}', [CollectionController::class, 'putOnSaleCollection'])->name('collections.sale');
Route::get('/collections/{collection}',  [CollectionController::class, 'show'])->name('collection.getOne');
Route::get('/collections/{collection}/addNft',  [CollectionController::class, 'addNft'])->name('collection.addNft')->middleware('admin');

// USERS
// Views
Route::get('/users/create', [UserController::class, 'create'])->middleware('admin');
Route::get('/users/create', [UserController::class, 'create'])->middleware('admin');
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
//View for bid
Route::get('/nfts/buy/{nft}', function ($id) {
    $nft = \App\Models\Nft::whereId($id)->first();

    return view('nfts.buy')->with('nft', $nft);
});
//BID
Route::post('/nfts/bid/{nft}', [NftController::class, 'bidNFT'])->name('nft.bid');
//PURCHASE
Route::post('/nfts/purchase/{nft}', [NftController::class, 'purchaseNFT'])->name('nft.purchase');
//Put on sale
Route::put('nfts/sale/{nft}', [NftController::class, 'putOnSaleNFT'])->name('nfts.sale');
Route::put('nfts/auction/{nft}', [NftController::class, 'auction'])->name('nfts.auction');
//Close bid
Route::post('nfts/close/{nft}', [NftController::class, 'closeBid'])->name('nft.close');

//ARTISTS
//Order by name
Route::get('/artists/sortByName', [ArtistController::class, 'sortByName']);
Route::get('/artists/sortByBalance', [ArtistController::class, 'sortByBalance']);
Route::get('/artists/sortByVolume', [ArtistController::class, 'sortByVolume']);

//TYPES
//Order by name
Route::get('/types/sortByExclusivity', [TypeController::class, 'sortByExclusivity']);
//Route::get('/types/sortByCount', [TypeController::class, 'sortByCount']);


// ###########
// ## CRUDS ##
// ###########
Route::group(['prefix' => 'api'], function () {

    //## NFTS ##
    Route::get('/nfts/{nft}', [NftController::class, 'get'])->name('nft.getOne')->middleware('admin');
    Route::get('/nfts', [NftController::class, 'getAll'])->name('nft.getAll')->middleware('admin');
    Route::post('/nfts', [NftController::class, 'store'])->name('nft.store')->middleware('admin');
    Route::delete('/nfts', [NftController::class, 'delete'])->name('nft.delete')->middleware('admin');
    Route::put('/nfts', [NftController::class, 'update'])->name('nft.update')->middleware('admin');

    //## User ##
    Route::get('/users/{user}',  [UserController::class, 'get'])->name('user.getOne')->middleware('admin');
    Route::get('/users', [UserController::class, 'getAll'])->name('user.getAll')->middleware('admin');
    Route::post('/users', [UserController::class, 'create'])->name('user.create')->middleware('admin');
    Route::delete('/users', [UserController::class, 'delete'])->name('user.delete')->middleware('admin');
    Route::put('/users', [UserController::class, 'update'])->name('user.update')->middleware('admin');

    //## Collection ##
    Route::get('/collections/{collection}',  [CollectionController::class, 'get'])->name('collection.getOne')->middleware('admin');
    Route::get('/collections', [CollectionController::class, 'getAll'])->name('collection.getAll')->middleware('admin');
    Route::post('/collections', [CollectionController::class, 'store'])->name('collection.store')->middleware('admin');
    Route::delete('/collections', [CollectionController::class, 'delete'])->name('collection.delete')->middleware('admin');
    Route::put('/collections', [CollectionController::class, 'update'])->name('collection.update')->middleware('admin');

    //## Type ##
    Route::get('/types/{type}',  [TypeController::class, 'get'])->name('type.getOne')->middleware('admin');
    Route::get('/types', [TypeController::class, 'getAll'])->name('type.getAll')->middleware('admin');
    Route::post('/types', [TypeController::class, 'store'])->name('type.store')->middleware('admin');
    Route::delete('/types', [TypeController::class, 'delete'])->name('type.delete')->middleware('admin');
    Route::put('/types', [TypeController::class, 'update'])->name('type.update')->middleware('admin');

    //## Artist ##
    Route::post('/artists', [ArtistController::class, 'store'])->name('artist.store')->middleware('admin');
    Route::get('/artists/{artist}', [ArtistController::class, 'get'])->name('artist.getOne')->middleware('admin');
    Route::get('/artists', [ArtistController::class, 'getAll'])->name('artist.getAll')->middleware('admin');
    Route::delete('/artists', [ArtistController::class, 'delete'])->name('artist.delete')->middleware('admin');
    Route::put('/artists', [ArtistController::class, 'update'])->name('artist.update')->middleware('admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

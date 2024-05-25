<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\ListingController;
use \App\Http\Controllers\TestController;
use \App\Http\Controllers\UserInfoController;
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

Route::get('/', [ListingController::class, 'index']);

// ttt
Route::get('/sendSampleEmail', [TestController::class, 'sendSampleEmail']);
// ttt

Route::get(
    '/listings',
    [ListingController::class, 'index']
)->name('listings.index');

Route::get(
    '/listings/lazyload',
    [ListingController::class, 'lazyload']
)->name('listings.lazyload');

Route::get(
    '/listings/searchResult',
    [ListingController::class, 'searchResult']
)->name('listings.searchResult');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/userInfo/{user}/edit', [UserInfoController::class, 'edit'])->name('userInfo.edit');
    Route::put('/userInfo/{listing}', [UserInfoController::class, 'update'])->name('userInfo.update');


    Route::get(
        '/listings/create',
        [ListingController::class, 'create']
    )->name('listings.create');

    Route::post(
        '/listings/store',
        [ListingController::class, 'store']
    )->name('listings.store');

    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');

    Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');

    Route::get(
        '/dashboard',
        [ListingController::class, 'manage']
    )->name('dashboard');
});

Route::get(
    '/listings/{listing}',
    [ListingController::class, 'show']
)->name('listings.show');


require __DIR__ . '/auth.php';

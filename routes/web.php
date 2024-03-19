<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\ListingController;
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
    return view('listings');
});

Route::get(
    '/listings',
    [ListingController::class, 'index']
)->name('listings.index');

Route::get(
    '/listings/create',
    [ListingController::class, 'create']
)->name('listings.create');

Route::post(
    '/listings/store',
    [ListingController::class, 'store']
)->name('listings.store');

Route::delete(
    '/listings/{id}',
    [ListingController::class, 'destroy']
)->name('listings.destroy');

Route::get(
    '/listings/{id}',
    [ListingController::class, 'show']
)->name('listings.show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

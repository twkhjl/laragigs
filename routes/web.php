<?php

use App\Models\Listings;
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
    $listings = Listings::all();
    return view('listings', [
        'listings' => $listings
    ]);
});

Route::get('/listings/{id}', function ($id) {
    $listing = Listings::find($id);
    return view('listing', [
        'listing' => $listing
    ]);
});

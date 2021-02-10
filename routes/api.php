<?php

use App\Thing;
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

Route::get('/search/{query}', function ($query) {
    return Thing::search($query);
})->name('search');

Route::get('/{thing}', function (Thing $thing) {
    return $thing;
})->name('get');
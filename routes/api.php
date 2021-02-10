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

Route::get('/search/{query}', function (Request $request, $query) {
    return Thing::search($query, $request->containersOnly === 'true');
})->name('search');

Route::get('/{thing}', function (Thing $thing) {
    return $thing;
})->name('get');
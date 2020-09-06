<?php

use App\Thing;
use Illuminate\Http\Request;
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

Route::get('/search', function (Request $request) {
    $thing = Thing::find($request->q);
    if ($thing) {
        return redirect($thing->id);
    }
    return "No results, sorry";
});

Route::get('/{thing}', function (Thing $thing) {
    return view('thing', $thing);
});
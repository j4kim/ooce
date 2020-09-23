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

Route::view('/add', 'add');

Route::post('/create', function (Request $request) {
    $thing = Thing::create($request->all());
    return redirect($thing->id);
});

Route::get('/{thing}', function (Thing $thing) {
    return view('thing', compact('thing'));
});

Route::put('/{thing}/move', function (Thing $thing, Request $request) {
    $thing->parent_id = $request->parent_id;
    $thing->save();
    return redirect($thing->id);
});

Route::put('/{thing}/detach', function (Thing $thing) {
    $thing->parent_id = null;
    $thing->save();
    return redirect($thing->id);
});
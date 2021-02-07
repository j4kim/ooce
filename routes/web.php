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
    $thing = Thing::first();
    if (!$thing) {
        $thing = Thing::create();
    }
    return redirect($thing->id);
});

Route::get('/search', function (Request $request) {
    $thing = Thing::find($request->q);
    if ($thing) {
        return redirect($thing->id);
    }
    return "No results, sorry";
});

Route::get('/{thing}', function (Thing $thing) {
    return view('thing', compact('thing'));
});

Route::get('/{thing}/edit', function (Thing $thing) {
    return view('edit', compact('thing'));
});

Route::post('/{thing}/add', function (Thing $thing, Request $request) {
    $newthing = $thing->children()->create($request->all());
    return redirect($newthing->id);
});

Route::put('/{thing}/update', function (Thing $thing, Request $request) {
    $thing->update($request->all());
    return redirect($thing->id);
});

Route::put('/{thing}/move', function (Thing $thing, Request $request) {
    $thing->moveTo($request->parent_id);
    return redirect($thing->id);
});

Route::put('/{thing}/detach', function (Thing $thing) {
    $thing->moveTo(null);
    return redirect($thing->id);
});
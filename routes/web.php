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
    $root = Thing::doesntHave('parent')->orderBy('created_at')->first();
    $orphans = Thing::doesntHave('parent')
                    ->where('id', '!=', $root->id)
                    ->orderBy('moved_at', 'desc')
                    ->take(20)
                    ->get();
    return view('index', compact('root', 'orphans'));
})->name('index');

Route::post('/', function (Thing $thing) {
    $thing = Thing::create();
    return redirect(route('show', $thing->id));
})->name('create');

Route::get('/search', function (Request $request) {
    $thing = Thing::find($request->q);
    if ($thing) {
        return redirect(route('show', $thing->id));
    }
    return "No results, sorry";
})->name('search');

Route::get('/{thing}', function (Thing $thing) {
    return view('thing', compact('thing'));
})->name('show');

Route::get('/{thing}/edit', function (Thing $thing) {
    return view('edit', compact('thing'));
})->name('edit');

Route::post('/{thing}/add', function (Thing $thing, Request $request) {
    $newthing = $thing->children()->create($request->all());
    return redirect(route('edit', $newthing->id));
})->name('add');

Route::put('/{thing}/update', function (Thing $thing, Request $request) {
    $thing->update($request->all());
    return redirect(route('show', $thing->id));
})->name('update');

Route::put('/{thing}/move', function (Thing $thing, Request $request) {
    $thing->moveTo($request->parent_id);
    return redirect(route('show', $thing->id));
})->name('move');

Route::put('/{thing}/detach', function (Thing $thing) {
    $thing->moveTo(null);
    return redirect(route('show', $thing->id));
})->name('detach');

Route::delete('/{thing}', function (Thing $thing) {
    $parentId = $thing->parent_id;
    $thing->delete();
    return redirect($parentId ? route('show', $parentId) : '/');
})->name('delete');
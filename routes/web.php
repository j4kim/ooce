<?php

use App\Asset;
use App\Thing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        $root = Thing::doesntHave('parent')->orderBy('created_at')->first();
        $orphans = Thing::doesntHave('parent')
                        ->where('id', '!=', $root->id)
                        ->orderBy('moved_at', 'desc')
                        ->take(20)
                        ->get();
        return view('index', compact('root', 'orphans'));
    })->name('index');

    Route::post('/create', function () {
        $thing = Thing::create();
        return redirect(route('edit', $thing->id));
    })->middleware('isjojo')->name('create');

    Route::get('/search/{query}', function ($query) {
        $things = Thing::search($query);
        if (count($things) === 1) {
            return redirect(route('show', $things->first->id));
        }
        return view('search-result', compact('things', 'query'));
    })->name('search');

    Route::get('/{thing}', function (Thing $thing) {
        return view('thing', compact('thing'));
    })->name('show');

    Route::get('/{thing}/edit', function (Thing $thing) {
        return view('edit', compact('thing'));
    })->name('edit');

    Route::put('/{thing}/duplicate', function (Thing $thing) {
        $newThing = $thing->replicate();
        $newThing->save();
        return redirect(route('show', $newThing));
    })->middleware('isjojo')->name('duplicate');

    Route::post('/{thing}/add', function (Thing $thing, Request $request) {
        $newthing = $thing->children()->create($request->all());
        return redirect(route('edit', $newthing->id));
    })->middleware('isjojo')->name('add');

    Route::put('/{thing}/update', function (Thing $thing, Request $request) {
        $attributes = $request->except('picture');
        if ($request->hasFile('picture')) {
            $picture_path = $request->file('picture')->store('uploads');
            $asset_path = Asset::create($picture_path);
            $attributes = array_merge($attributes, compact('picture_path', 'asset_path'));
        }
        $thing->fill($attributes);
        $thing->thing_container = $request->thing_container === 'on';
        if ($thing->isDirty('parent_id')) {
            $thing->moved_at = now();
        }
        $thing->save();
        return redirect(route('show', $thing->id));
    })->middleware('isjojo')->name('update');

    Route::delete('/{thing}', function (Thing $thing) {
        $parentId = $thing->parent_id;
        $thing->delete();
        return redirect($parentId ? route('show', $parentId) : '/');
    })->middleware('isjojo')->name('delete');

});
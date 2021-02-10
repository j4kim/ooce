<?php

use App\Asset;
use App\Thing;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\Exception\NotReadableException;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('create-assets', function () {
    $things = Thing::whereNull('asset_path')->whereNotNull('picture_path')->get();
    foreach ($things as $thing) {
        $this->line("Generate asset for thing $thing->id");
        try {
            $thing->asset_path = Asset::create($thing->picture_path);
            $thing->save();
            $this->info($thing->asset_path);
        } catch (NotReadableException $e) {
            $this->error($e->getMessage());
        }
    }
});
<?php

use App\Thing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $place = Thing::create(['name' => 'Neuve 3']);
        $cellar = $place->children()->create(['name' => 'Cave']);
        $box = $cellar->children()->create(['name' => 'Boîte']);
    }
}

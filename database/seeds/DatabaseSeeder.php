<?php

use App\Place;
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
        $place = new Place();
        $place->key = "Neuve 3";
        $place->save();
    }
}

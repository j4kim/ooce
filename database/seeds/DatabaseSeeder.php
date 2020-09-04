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
        $place = new Thing();
        $place->key = "Neuve 3";
        $place->save();

        $cellar = new Thing();
        $cellar->key = "Cave";
        $place->children()->save($cellar);

        $box = new Thing();
        $box->key = "Box";
        $cellar->children()->save($box);
    }
}

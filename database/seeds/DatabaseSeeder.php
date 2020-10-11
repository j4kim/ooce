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
        Thing::create(['name' => 'Neuve 3']);
    }
}

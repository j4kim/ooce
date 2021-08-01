<?php

use App\Group;
use App\Thing;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Joaquim',
            'email' => 'jivkim@gmail.com',
            'password' => Hash::make('password')
        ]);
        $group = Group::create([
            'name' => 'neuve3'
        ]);
        $group->users()->attach($user);
        $group->things()->create([
            'name' => 'Neuve 3',
            'is_root' => true,
            'ref' => 1
        ]);
    }
}

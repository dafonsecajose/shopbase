<?php

namespace Database\Seeders;

use App\Address;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create()->each(function ($user) {

            $user->adresses()->save(Address::factory()->make());
        });
    }
}

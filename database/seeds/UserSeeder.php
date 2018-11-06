<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 10; $i++) { 
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => \Hash::make($faker->name)
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\{
    Post,
    User
};
use Faker\Factory as Faker;

class PostSeeder extends Seeder
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
            Post::create([
                'user_id' => User::first()->id,
                'content' => $faker->text
            ]);
        }
    }
}

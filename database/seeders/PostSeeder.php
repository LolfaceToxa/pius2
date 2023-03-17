<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker;
use Faker\Generator;
use DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 100; $i++) { 
            DB::table("posts")->insert([
                'title' => $faker->word(),
                'date' => $faker->dateTimeBetween('-5 years', 'now'),
                'code' => Str::slug($faker->unique()->randomNumber()),
                'text' => $faker->sentence(),
                'author' =>  $faker->name(),
            ]);
        }
    }
}

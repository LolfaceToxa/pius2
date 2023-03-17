<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker;
use Faker\Generator;
use DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private function string_arr($array): string
    {
        $str = '[';
        foreach ($array as $val){
            $str .= $val.', ';
        }
        $str = substr($str, 0, strlen($str)-2);

        return $str.']';
    }

    
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $arr = [];
        for ($i = 1; $i <= 100; $i++){
            $arr[] = $i; 
        }


        for ($i=0; $i < 100; $i++) {
            DB::table("tags")->insert([
                'name' => $faker->word(),
                'post_id'=> $this->string_arr($faker->randomElements($arr, $faker->randomDigitNot(0))),
            ]);
        }
    }
}

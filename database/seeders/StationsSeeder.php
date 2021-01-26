<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('stations')->insert([
                'name'=> $faker->cityPrefix . " " . $faker->streetSuffix,
                'location'=>$faker->city,
                'votes'=>$faker->numberBetween(100,9999),
                'pending'=>$faker->numberBetween(0,1),
                'created_at'=>$faker->dateTimeThisMonth(),
                'updated_at'=>$faker->dateTimeThisMonth(),
            ]);
        }
    }
}

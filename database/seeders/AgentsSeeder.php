<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AgentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,15) as $index) {
            DB::table('agents')->insert([
                'name'=> $faker->name,
                'id_number'=>$faker->numberBetween(9999999,49999999),
                'phone_number'=>$faker->e164PhoneNumber,
                'email'=>$faker->unique()->freeEmail,
                'votes'=>$faker->numberBetween(0,0),
                'stream_id'=>$faker->numberBetween(1,10),
                'created_at'=>$faker->dateTimeThisMonth(),
                'updated_at'=>$faker->dateTimeThisMonth(),
            ]);
        }
    }
}

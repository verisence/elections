<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VotersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,1) as $index) {
            DB::table('voters')->insert([
                'name'=> $faker->name,
                'id_number'=>$faker->numberBetween(9999999,49999999),
                'phone_number'=>$faker->e164PhoneNumber,
                'email'=>$faker->unique()->freeEmail,
                'created_at'=>$faker->dateTimeThisMonth(),
                'updated_at'=>$faker->dateTimeThisMonth(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,30) as $index) {
            DB::table('payments')->insert([
                'amount'=>$faker->numberBetween(4999,500001),
                'agent_id'=>$faker->numberBetween(1,15),
                'created_at'=>$faker->dateTimeThisMonth(),
                'updated_at'=>$faker->dateTimeThisMonth(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,50) as $index) {
            DB::table('messages')->insert([
                'title'=> $faker->sentence(4),
                'message'=>$faker->paragraph(8),
                'created_at'=>$faker->dateTimeThisMonth(),
                'updated_at'=>$faker->dateTimeThisMonth(),
            ]);
        }
    }
}

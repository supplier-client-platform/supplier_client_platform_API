<?php

use Illuminate\Database\Seeder;

class CityListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city_list')->insert([
            'city' => 'Colombo',
            'created_at' => '2016-10-25 00:00:00',
            'updated_at' => '2016-10-31 00:00:00',
        ]);

        DB::table('city_list')->insert([
            'city' => 'Negombo',
            'created_at' => '2016-10-25 00:00:00',
            'updated_at' => '2016-10-31 00:00:00',
        ]);

        DB::table('city_list')->insert([
            'city' => 'Kandy',
            'created_at' => '2016-10-25 00:00:00',
            'updated_at' => '2016-10-31 00:00:00',
        ]);

        DB::table('city_list')->insert([
            'city' => 'Gampaha',
            'created_at' => '2016-10-25 00:00:00',
            'updated_at' => '2016-10-31 00:00:00',
        ]);
    }
}

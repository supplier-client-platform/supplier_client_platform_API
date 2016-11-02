<?php

use Illuminate\Database\Seeder;

class SupplierCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supplier_category')->insert([
            'name' => 'Food Chain',
            'created_at' => '2016-10-25 00:00:00',
            'updated_at' => '2016-10-31 00:00:00',
        ]);

        DB::table('supplier_category')->insert([
            'name' => 'Super Market',
            'created_at' => '2016-10-25 00:00:00',
            'updated_at' => '2016-10-31 00:00:00',
        ]);
    }
}

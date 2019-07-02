<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'user_id' => 1,
                'name' => 'Eka Putra',
                'gender' => 'pria',
                'image' => null,
                'active' => true
            ]
        ]);
    }
}

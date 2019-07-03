<?php

use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sellers')->insert([
            [
                'user_id' => 2,
                'name' => 'Eka Putra',
                'gender' => 'pria',
                'image' => null,
                'active' => true
            ]
        ]);
    }
}

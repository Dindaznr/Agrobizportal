<?php

use Illuminate\Database\Seeder;

class AddressesUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            [
                // 'user_id' => 1,
                'customer_id' => 1,
                'alias' => 'Kantor',
                'name' => 'Graha Chantia Jl. Bangka Raya RT.2/RW.7',
                'city' => 'Kota Jakarta Selatan',
                'province' => 'Daerah Khusus Ibukota Jakarta',
                'district' => 'Pela Mampang Mampang Prpt.'
            ]
        ]);
    }
}

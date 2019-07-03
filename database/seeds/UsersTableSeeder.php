<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role' => 'customer',
                'email' => 'rahmannisa20@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => new \DateTime()
            ],
            [
                'role' => 'seller',
                'email' => 'eka378putra@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => new \DateTime()
            ]
        ]);
    }
}

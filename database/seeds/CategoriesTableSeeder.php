<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Pakaian Pria',
                'slug' => 'pakaian-pria',
                'active' => true,
            ],
            [
                'name' => 'Pakaian Wanita',
                'slug' => 'pakaian-wanita',
                'active' => true,
            ],
            [
                'name' => 'Kesehatan',
                'slug' => 'kesehatan',
                'active' => true,
            ],
            [
                'name' => 'Kecantikan',
                'slug' => 'kecantikan',
                'active' => true,
            ],
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'active' => true,
            ],
            [
                'name' => 'Smartphone',
                'slug' => 'smartphone',
                'active' => true,
            ],
            [
                'name' => 'Komputer & Aksesoris',
                'slug' => 'komputer-dan-aksesoris',
                'active' => true,
            ],
            [
                'name' => 'Kamera',
                'slug' => 'kamera',
                'active' => true,
            ],
            [
                'name' => 'Otomotif',
                'slug' => 'otomotif',
                'active' => true,
            ],
        ]);
    }
}

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
                'name' => 'Alat Pertanian',
                'slug' => 'alat-pertanian',
                'active' => true,
            ],
            [
                'name' => 'Hasil Pertanian',
                'slug' => 'hasil-pertanian',
                'active' => true,
            ],
            [
                'name' => 'Bibit',
                'slug' => 'bibit',
                'active' => true,
            ],
            [
                'name' => 'Herbal',
                'slug' => 'herbal',
                'active' => true,
            ],
            [
                'name' => 'Kerajinan',
                'slug' => 'kerajinan',
                'active' => true,
            ],
        ]);
    }
}

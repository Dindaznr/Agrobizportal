<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'user_id' => 2,
            'name' => 'Jagung Manis Kupas Organik Non Pestisida 1 Pack x 500 Gram',
            'slug' => 'Jagung-Manis-Kupas-Organik-Non-Pestisida-1-Pack-x-500-Gram',
            'description' => 'Jagung Manis Kupas Organik. Ditanam secara alami, tanpa menggunakan bahan kimia dan obat-obatan kimia.',
            'image' => 'product-sample/jagung.png',
            'price' => 17000,
            'stock' => 10,
            'active' => true,
            'rate_count' => 0,
            'sale_counts' => 0
        ]);

        DB::table('category_product')->insert([
            'category_id' => 1,
            'product_id' => 1
        ]);
        
        Product::create([
            'user_id' => 2,
            'name' => 'Benih Padi Unggul M400',
            'slug' => 'Benih-Padi-Unggul-M400',
            'description' => 'Umur : 90 hari setelah tanam. Potensi hasil : 11 Ton / hektar. Rata-rata Hasil : 8,8 ton / hektar. Jumlah bulir : 280-400 bulir per malai. Rebah : tahan kerebahan. Ketahanan : Tahan wereng dan jamur.',
            'image' => 'product-sample/padi.png',
            'price' => 115000,
            'stock' => 10,
            'active' => true,
            'rate_count' => 0,
            'sale_counts' => 0
        ]);

        DB::table('category_product')->insert([
            'category_id' => 2,
            'product_id' => 2
        ]);
        
        Product::create([
            'user_id' => 2,
            'name' => 'Pupuk kompos 15 kg',
            'slug' => 'Pupuk-Kompos-15-kg',
            'description' => 'Cocok untuk pupuk berbagai macam tanaman agar lebih subur.',
            'image' => 'product-sample/pupuk.jpg',
            'price' => 20000,
            'stock' => 10,
            'active' => true,
            'rate_count' => 0,
            'sale_counts' => 0
        ]);

        DB::table('category_product')->insert([
            'category_id' => 3,
            'product_id' => 3
        ]);
        
        Product::create([
            'user_id' => 2,
            'name' => 'Alat Semprot Hama 2 Liter Tasco Murah',
            'slug' => 'Alat-Semprot-Hama-2-Liter-Tasco-Murah',
            'description' => 'Merk : Tasco. Kapasitas Tanki : 2 Liter. Made In KOREA.',
            'image' => 'product-sample/sprayhama.jpg',
            'price' => 53000,
            'stock' => 10,
            'active' => true,
            'rate_count' => 0,
            'sale_counts' => 0
        ]);

        DB::table('category_product')->insert([
            'category_id' => 4,
            'product_id' => 4
        ]);
        
        Product::create([
            'user_id' => 2,
            'name' => 'Melia Propolis Original Mss Melia Sehat Sejahtera',
            'slug' => 'Melia-Propolis-Original-Mss-Melia-Sehat-Sejahtera',
            'description' => 'Kemasan Asli , 1 Box isi 7 Botol.',
            'image' => 'product-sample/propolis.jpg',
            'price' => 240000,
            'stock' => 10,
            'active' => true,
            'rate_count' => 0,
            'sale_counts' => 0
        ]);

        DB::table('category_product')->insert([
            'category_id' => 5,
            'product_id' => 5
        ]);
    }
}

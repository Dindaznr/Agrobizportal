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
            'name' => 'Jaket WP Pria Kantor New Tab Waterprof Aklirik/ Jaket Motor WP Kekinian / Harington',
            'slug' => 'Jaket-WP-Pria-Kantor-New-Tab-Waterprof-Aklirik-Jaket-Motor-WP-Kekinian-Harington',
            'description' => 'Jaket New Tab Pria Kantor Waterprof / Jaket Motor WP Kekinian',
            'image' => 'product-sample/c9d6029e1f0edfb61fab93829fe1cc6d.png',
            'price' => 91000,
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
            'name' => 'Preloved Savanah Dress Ash SAGARA XS',
            'slug' => 'Preloved-Savanah-Dress-Ash-SAGARA-XS',
            'description' => 'Preloved Savanah Dress Ash SAGARA bahan Linen Lorita, LD 86, Panjang 140 bahan adem.',
            'image' => 'product-sample/a51e8303be2783a44c6bbb990e33699e.png',
            'price' => 280000,
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
            'name' => 'Ever E Isi 30 Softgels',
            'slug' => 'Ever-E-Isi-30-Softgels',
            'description' => 'Ever E adalah produk vitamin E 250 IU yg bermanfaat sebagai antioksidan yg mampu menangkal radikal bebas. Ever E menggunakan kapsul lunak Vegicaps yg terbuat dari rumput laut sehingga cocok digunakan oleh vegetarian.',
            'image' => 'product-sample/b9d6bbb9148cd3c7d0402523136b741d.png',
            'price' => 48500,
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
            'name' => 'Peripera Peri Ink Velvet',
            'slug' => 'Peripera-Peri-Ink-Velvet',
            'description' => '[Peripera] Peri Ink Velvet',
            'image' => 'product-sample/1a7889a87164b1b98eb38ead1789c823.png',
            'price' => 63500,
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
            'name' => 'Miyako - MCM 612 Magic Com 1.2L 3in1 350W',
            'slug' => 'Miyako-MCM-612-Magic-Com-1.2L-3in1-350W',
            'description' => 'Miyako Magic Com 1.2 Liter - MCM-612 memudahkan anda dalam membuat makanan bergizi dan lezat. Dapat digunakan sebagai pengukus, penanak, dan dapat menghangatkan kembali makanan yang mulai dingin.',
            'image' => 'product-sample/2ce70379717e35517bcc9c666b452abd.png',
            'price' => 248087,
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

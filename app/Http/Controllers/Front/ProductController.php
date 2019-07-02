<?php

namespace App\Http\Controllers\Front;

use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display the specified product by slug.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $product = Product::with(
            [
                'categories' => function ($q) {
                    $q->select('name', 'slug');
                }
            ]
        )
        ->whereSlug($slug)
        ->firstOrFail();
        
        return view('product-detail', compact('product'));
    }

    /**
     * Display a listing of the product for the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function category(Category $category)
    {
        $products = Product::select('id', 'name', 'slug', 'description', 'image', 'price', 'stock')
            ->whereActive(true)
            ->latest()
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.slug', $category->slug);
            })->get();
        $info = __('Posts for category: ') . '<strong>' . $category->title . '</strong>';

        return view('product-category', compact('products', 'category', 'info'));
    }
}

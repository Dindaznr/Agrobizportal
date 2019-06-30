<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Model\Product;
use App\Model\Category;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('product', Product::whereActive(true)->limit(1)->latest()->first());
        $view->with('categories', Category::select('name', 'slug')->limit(5)->get());
    }
}

<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
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
        $view->with('categories', Category::select('name', 'slug')->get());
    }
}

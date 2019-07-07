<?php

namespace App\Http\Controllers\Back;

use App\Model\Category;
use App\Model\Product;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereStatus('closed');
                });
            }
        ])->get();
        
        return view('admin.dashboard', compact('products'));
    }
}

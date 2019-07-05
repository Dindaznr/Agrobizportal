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
        $categories = Category::all();
        $orders = Order::where('status', 'closed')->get();
        $products = Product::with([
            'orderItem' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereStatus('closed');
                });
            }
        ])->get();
        
        // if (count($orders)) {
        //     foreach($orders as $order){
        //         $products = $order->orderItem->map(function($item) use ($order) {
        //             return [
        //                 'name' => $item->product->name,
        //                 'sale_counts' => $item->product->sale_counts,
        //                 'sale_counts_price' => ($item->product->sale_counts * $item->product->price),
        //                 'transaction' => 1
        //             ];
        //         });
        //     }
        // } else {
        //     $products = [];
        // }

        // $products = $products->map(function ($product){
        //     $product->orderItem->map(function($item) {
        //         if (isset($item->order)) {
        //             $item->transact
        //         }
        //     });
        // });

        // dd($products);
        
        return view('admin.dashboard', compact('products'));
    }
}

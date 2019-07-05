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
        $products = Product::all();
        foreach ($products as $key => $product) {
            foreach($product->itemOrder as $item) {
                $item->order($item->order_id)->get();
            }
            // return $query->whereHas('status', function ($q) use ($name) {
            //         $q->where('name', $name);
            // });
        }
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
        
        return view('admin.dashboard', compact('products'));
    }
}

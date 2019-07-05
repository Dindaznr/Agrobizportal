<?php

namespace App\Http\Controllers\Back;

use App\Model\Category;
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
        $products = null;
        foreach($orders as $order){
            $products = $order->orderItem->map(function($item) use ($order) {
                return [
                    'name' => $item->product->name,
                    'sale_counts' => $item->sale_counts,
                    'sale_counts_price' => ($item->sale_counts * $item->price),
                    'transaction' => count($order->orderItem)
                ];
            });
        }

        // dd($products);

        return view('admin.dashboard', compact('products'));
    }
}

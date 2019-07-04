<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Order;
use App\Model\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display customer order page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer = Auth::user()->customer;

        $orders = Order::where('customer_id', $customer->id)->get();
        return view('order', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        
        $products = array_map(function ($id, $quantity){
            return [
                'id' => $id,
                'quantity' => $quantity
            ];
        }, $request->product_ids, $request->quantitys);
        
        $products = array_map(function ($product, $price){
            return [
                'id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $price
            ];
        }, $products, $request->prices);
        
        $resi = null;
        if ($request->payment_type != 'cod') {
            $resi = rand(1,100000) .''.mt_rand(1,100000);
        }
        $order = Order::create([
            'code' => 'INV/'. Carbon::now()->format('Ymd') .'/XIX/II/'. mt_rand(1,100000),
            'resi_number' => $resi,
            'customer_id' => $request->customer_id,
            'address_id' => $request->address_id,
            'seller_id' => $request->seller_id,
            'status' => 'open',
            'type' => 'order',
            'payment' => $request->payment_type
        ]);
        
        foreach($products as $product) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price']
            ]);
        }

        $cart = session()->get('cart');

        if ($cart) {
            session()->forget('cart');
        }

        $customer->user->SendOrderCreatedEmail($customer->user, $order);

        $status = "Silahkan melakukan pembayaran.";

        return redirect()->route('people.order')->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->id)
        {
            $order = Order::find($request->id)->first();
            $order->status = $request->status;
            $order->save();

            foreach($order->orderItem as $item) {
                $this->updateStockProduct($item->product->id);
            }

            return $order;
        }
    }

    private function updateStockProduct($id)
    {
        $product = Product::find($id)->first();
        $stok = ($product->stock - 1);
        
        $product->stock = $stok;
        $product->save();

        return $product;
    }
}

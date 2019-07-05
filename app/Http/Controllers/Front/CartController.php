<?php

namespace App\Http\Controllers\Front;

use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the product has been adding.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function cart(Request $request)
    {   
        return view('cart');
    }
    
    /**
     * Display a listing of the product has been adding.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        
        $user = $request->user();
        $address = $user->customer->address;
        if (!$address) {
            return redirect('/profile/address')->with('status', 'Silahkan lengkapi data Alamat Anda');    
        }

        $carts = session()->get('cart');
        if (is_null($carts)) {
            return redirect()->route('home')->with('status', 'Silahkan lengkapi data Alamat Anda');    
        }

        return view('checkout', compact('user', 'address', 'carts'));
    }
    
    /**
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request, $id)
    {
        $product = Product::with(
            [
                'categories' => function ($q) {
                    $q->select('name', 'slug');
                }
            ]
        )
        ->whereId($id)
        ->firstOrFail();

        if (is_null($product)) {
            return redirect()->back()->with(['error' => 'Product tidak ada']);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
 
            $cart = [
                    $id => [
                        "id" => $product->id,
                        "name" => $product->name,
                        "slug" => $product->slug,
                        "quantity" => $request->quantity,
                        "price" => $product->price,
                        "total" => ($product->price * $request->quantity),
                        "image" => $product->image,
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect('/cart')->with('status', 'Produk berhasil ditambahkan ke keranjang');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
 
            $cart[$id]['quantity'] = $request->quantity;
 
            session()->put('cart', $cart);
 
            return redirect('/cart')->with('status', 'Produk berhasil ditambahkan ke keranjang');
 
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id" => $product->id,
            "name" => $product->name,
            "slug" => $product->slug,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "total" => ($product->price * $request->quantity),
            "image" => $product->image
        ];
 
        session()->put('cart', $cart);

        return redirect('/cart')->with('status', 'Produk berhasil ditambahkan ke keranjang');
    }

    /**
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
            $cart[$request->id]["total"] = ($cart[$request->id]["price"] * $request->quantity);
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }
    
    /**
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    }
}

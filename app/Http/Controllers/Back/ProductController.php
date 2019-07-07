<?php

namespace App\Http\Controllers\Back;

use ImageController;
use App\Model\Product;
use App\Model\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $products = Product::where('user_id', $user->id)->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereActive(true)->pluck('name', 'id');
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $user = Auth::user();
        $request['slug'] = $this->slugify($request->slug);
        $request['active'] = 'on' === $request->active;
        $image = $this->uploadImage($request->file('featured_image'));
        $request['image'] = $image;
        $request['user_id'] = $user->id;
        $product = Product::create($request->all());

        $product->categories()->sync([$request->category]);
        return redirect()->back()->with(['info' => 'Data produk berhasil di tambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::whereActive(true)->pluck('name', 'id');
        return view('admin.product.edit', compact ('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $user = Auth::user();
        $request['slug'] = $this->slugify($request->slug);
        $request['active'] = 'on' === $request->active;
        $image = $this->uploadImage($request->file('featured_image'));
        $request['image'] = $image;
        $request['user_id'] = $user->id;
        $product->update($request->all());

        $product->categories()->sync([$request->category]);
        return redirect()->route('products.index')->with(['info' => 'Data produk berhasil di ubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }

    /**
     * upload picture static page.
     *
     * @param mixed $file
     *
     * @return string
     */
    protected function uploadImage($file = null)
    {
        if (!is_null($file)) {
            return ImageController::upload($file, 'product-sample/upload');
        }
    }

    public function slugify ($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}

<?php

namespace App\Http\Controllers\Back;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereStatus('closed');
                });
            }
        ])->get();

        return view('admin.report.sales', compact('products'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function income(Request $request)
    {
        return 'comming soon';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivery(Request $request)
    {
        return 'comming soon';
    }

}

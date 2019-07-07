<?php

namespace App\Http\Controllers\Back;

use PDF;
use App\Model\Product;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
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
    
    public function exportSales(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereStatus('closed');
                });
            }
        ])->get();
        $pdf = PDF::loadView('admin.report.sales_pdf', ['products' => $products]);
        // return $pdf->download('invoice.pdf');
    	return $pdf->stream();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function income(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereStatus('closed');
                });
            }
        ])->get();

        return view('admin.report.income', compact('products'));
    }

    public function exportIncome(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereStatus('closed');
                });
            }
        ])->get();
        $pdf = PDF::loadView('admin.report.income_pdf', ['products' => $products]);
        return $pdf->stream();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivery(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereStatus('closed');
                    $q->where('payment', 'transfer');
                });
            }
        ])->get();
        return view('admin.report.delivery', compact('products'));
    }

    public function exportDelivery(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereStatus('closed');
                    $q->where('payment', 'transfer');
                });
            }
        ])->get();
        $pdf = PDF::loadView('admin.report.delivery_pdf', ['products' => $products]);
        return $pdf->stream();
    }
}

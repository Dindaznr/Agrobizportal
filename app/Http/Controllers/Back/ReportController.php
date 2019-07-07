<?php

namespace App\Http\Controllers\Back;

use PDF;
use Carbon\Carbon;
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
            'orderItem' => function ($query) use($request) {
                $query->whereHas('order', function ($q) use($request) {
                    $startDate = Carbon::now()->toDateString();
                    if ($request->has('start_date')) {
                        $startDate = Carbon::parse($request->start_date)->toDateString();
                    }
                    
                    $endDate = Carbon::now()->endOfMonth()->subMonth()->endOfMonth()->toDateString();
                    if ($request->has('end_date')) {
                        $endDate = Carbon::parse($request->end_date)->toDateString();
                    }
                    
                    $q->whereStatus('closed');
                    $q->whereBetween('updated_at', [ $startDate, $endDate ]);
                });
            }
        ])->get();

        return view('admin.report.sales', compact('products'));
    }
    
    public function exportSales(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) use($request) {
                $query->whereHas('order', function ($q) use($request) {
                    $startDate = Carbon::now()->toDateString();
                    if ($request->has('start_date')) {
                        $startDate = Carbon::parse($request->start_date)->toDateString();
                    }
                    
                    $endDate = Carbon::now()->endOfMonth()->subMonth()->endOfMonth()->toDateString();
                    if ($request->has('end_date')) {
                        $endDate = Carbon::parse($request->end_date)->toDateString();
                    }

                    $q->whereStatus('closed');
                    $q->whereBetween('updated_at', [ $startDate, $endDate ]);
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
            'orderItem' => function ($query) use($request) {
                $query->whereHas('order', function ($q) use($request) {
                    $startDate = Carbon::now()->toDateString();
                    if ($request->has('start_date')) {
                        $startDate = Carbon::parse($request->start_date)->toDateString();
                    }
                    
                    $endDate = Carbon::now()->endOfMonth()->subMonth()->endOfMonth()->toDateString();
                    if ($request->has('end_date')) {
                        $endDate = Carbon::parse($request->end_date)->toDateString();
                    }

                    $q->whereStatus('closed');
                    $q->whereBetween('updated_at', [ $startDate, $endDate ]);
                });
            }
        ])->get();

        return view('admin.report.income', compact('products'));
    }

    public function exportIncome(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) use($request) {
                $query->whereHas('order', function ($q) use($request) {
                    $startDate = Carbon::now()->toDateString();
                    if ($request->has('start_date')) {
                        $startDate = Carbon::parse($request->start_date)->toDateString();
                    }
                    
                    $endDate = Carbon::now()->endOfMonth()->subMonth()->endOfMonth()->toDateString();
                    if ($request->has('end_date')) {
                        $endDate = Carbon::parse($request->end_date)->toDateString();
                    }

                    $q->whereStatus('closed');
                    $q->whereBetween('updated_at', [ $startDate, $endDate ]);
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
            'orderItem' => function ($query) use($request) {
                $query->whereHas('order', function ($q) use($request) {
                    $startDate = Carbon::now()->toDateString();
                    if ($request->has('start_date')) {
                        $startDate = Carbon::parse($request->start_date)->toDateString();
                    }
                    
                    $endDate = Carbon::now()->endOfMonth()->subMonth()->endOfMonth()->toDateString();
                    if ($request->has('end_date')) {
                        $endDate = Carbon::parse($request->end_date)->toDateString();
                    }
                    
                    $q->whereStatus('closed');
                    $q->where('payment', 'transfer');
                    $q->whereBetween('updated_at', [ $startDate, $endDate ]);
                });
            }
        ])->get();
        return view('admin.report.delivery', compact('products'));
    }

    public function exportDelivery(Request $request)
    {
        $products = Product::with([
            'orderItem' => function ($query) use($request) {
                $query->whereHas('order', function ($q) use($request) {
                    $startDate = Carbon::now()->toDateString();
                    if ($request->has('start_date')) {
                        $startDate = Carbon::parse($request->start_date)->toDateString();
                    }
                    
                    $endDate = Carbon::now()->endOfMonth()->subMonth()->endOfMonth()->toDateString();
                    if ($request->has('end_date')) {
                        $endDate = Carbon::parse($request->end_date)->toDateString();
                    }

                    $q->whereStatus('closed');
                    $q->where('payment', 'transfer');
                    $q->whereBetween('updated_at', [ $startDate, $endDate ]);
                });
            }
        ])->get();
        $pdf = PDF::loadView('admin.report.delivery_pdf', ['products' => $products]);
        return $pdf->stream();
    }
}

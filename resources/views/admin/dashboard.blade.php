@extends('layouts.app-dashboard')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <!-- <button class="btn btn-sm btn-outline-secondary">Share</button> -->
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
        </button> -->
    </div>
</div>

    @admin
    <h2>Rincian Transaksi</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Total Penjualan (Unit)</th>
                    <th>Total Penjualan (Rupiah)</th>
                    <th>Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $no => $product)
                <tr>
                    <td>{{ $no += 1 }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['sale_counts'] ? $product['sale_counts'] : 0 }}</td>
                    <td>{{ number_format($product['price'] * $product['sale_counts']) }}</td>
                    <td>{{ count($product->orderItem) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endadmin
    
    @seller
    <h2>Rincian Penjualan</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Total Penjualan (Unit)</th>
                    <th>Total Penjualan (Rupiah)</th>
                    <th>Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $no => $product)
                <tr>
                    <td>{{ $no += 1 }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['sale_counts'] }}</td>
                    <td>{{ number_format($product['price'] * $product['sale_counts']) }}</td>
                    <td>{{ count($product->orderItem) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endseller
@endsection

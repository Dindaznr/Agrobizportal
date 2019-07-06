@extends('layouts.app-dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Customer Data</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
    </div>
</div>
<table class="table text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Total Transaksi Selesai</th>
            <th scope="col">Total Transaksi Di Batalkan</th>
            <th scope="col">Active</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $no => $customer)
        <?php
            $trColor = '';
            $trTitile = '';
            if ($customer->active === false) {
                $trColor = 'table-success';
                $trTitile = 'transaksi anda di batalkan';
            } 
        ?>
        <tr class="{{ $trColor }}" title="{{ $trTitile }}">
            <th scope="row">1</th>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->gender }}</td>
            <td>{{ $customer->success_orders->count() }}</td>
            <td>{{ $customer->cancelled_orders->count() }}</td>
            <td>{{ true == $customer->active ? 'Ya' : 'Tidak' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@extends('layouts.app')

@section('css')

@stop

@section('content')
<div class="container">
    <div style="min-height: 500px;">
        <div class="row" style="margin-top: 50px;">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">    
                        <h4 class="card-title">Checkout</h4>
                        <h5 class="card-title">Alamat Pengiriman</h5>
                        <hr>
                        <h5 class="card-title">
                            {{ $user->customer->name }}
                            <p class="card-text font-weight-light">
                                {{ $address->name }},
                                {{ $address->district }}, {{ $address->city }}, {{ $address->province }}
                            </p>
                        </h5>
                    </div>
                </div>
                
                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header text-center">
                                Tinjau Pesanan Anda & Checkout
                            </div>
                            <?php
                                $total = 0;
                            ?>
                            <div class="card-body">
                                <!-- <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($carts as $id => $details)
                                        <?php
                                            $total += $details['total'];
                                        ?>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $details['name'] }}</td>
                                            <td>{{ number_format($details['price']) }}</td>
                                            <td>{{ $details['quantity'] }}</td>
                                            <td>{{ number_format($details['total']) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                $total = 0;
                foreach($carts as $id => $details) {
                    $total += $details['total'];
                }
            ?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header text-center">
                        Ringkasan Belanja
                    </div>
                    <div class="card-body">
                        <hr>
                        <p class="card-text">Total Harga ({{ count($carts) }} Jenis barang) - Rp {{ number_format($total) }}</p>
                        <hr>
                        <p class="card-text">Jenis Pembayaran</p>
                        <select name="payment_type" class="form-control">
                            <option></option>
                            <option value="cod">Cash on delivery</option>
                            <option value="transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="card-footer bg-transparent text-center">
                        <button type="button" class="btn btn-success font-weight-bold">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
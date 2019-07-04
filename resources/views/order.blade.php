@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @component('components.sidebar-profile') @endcomponent
        
        <div class="col">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row" style="min-height: 500px;">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">Daftar Belanja</div>
                        <div class="card-body">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Transaksi Code</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) > 0)
                                        @foreach($orders as $no => $order)
                                        <tr class="{{ $order->status === 'cancelled' ? 'table-warning' : ''}}">
                                            <th scope="row">{{ $no +=1 }}</th>
                                            <td>
                                                <a data-toggle="collapse" href="#collapseOrder_{{$no}}" role="button" aria-expanded="false" aria-controls="collapseOrder_{{$no}}">
                                                    {{ $order->code }}
                                                </a>
                                            </td>
                                            <td>Rp. {{ number_format( array_sum(array_map(function ($item) {
                                                return $item['price'];
                                            }, $order->orderItem->toArray())) ) }}</td>
                                            <td>
                                                @if($order->status == 'open')
                                                    Menunggu Pembayaran
                                                @elseif($order->status == 'paid')
                                                    Pesanan Sedang Di Proses
                                                @elseif($order->status == 'sent')
                                                    Pesanan Sedang Dalam Pengiriman
                                                @elseif($order->status == 'received')
                                                    Pesanan Sudah Sampai
                                                @elseif($order->status == 'cancelled')
                                                    Pesanan Di Batalkan
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->status !== 'received' AND $order->status !== 'cancelled')
                                                <button
                                                    id="btnGroupDropOption"
                                                    type="button"
                                                    class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDropOption">
                                                        @if($order->status == 'open')
                                                        <a class="dropdown-item update-order-confirm" data-id="{{ $order->id }}" href="#">Konfirmasi Pembayaran</a>
                                                        <a class="dropdown-item update-order-cancel" data-id="{{ $order->id }}" href="#">Batalkan</a>
                                                        @endif
                                                        @if($order->status == 'sent' OR $order->status == 'close')
                                                        <a class="dropdown-item update-order-received" data-id="{{ $order->id }}" href="#">Barang Sudah Di Terima</a>
                                                        @endif
                                                        <a class="dropdown-item" href="#"></a>
                                                </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <div class="collapse" id="collapseOrder_{{$no}}">
                                                <div class="card card-body">
                                                    <p><strong><small>Invoice : {{ $order->code }}</small> </strong></p>
                                                    <p><strong> No.Resi : {{ $order->resi_number }} </strong></p>
                                                    @foreach($order->orderItem as $item)
                                                        <p> <img class="rounded" src="{{ asset('image/'. $item->product->image) }}" height="100"/></p>
                                                        <p><strong>Product :</strong> {{ $item->product->name }}</p>
                                                        <p><strong>Price :</strong> {{ $item->product->price }}</p>
                                                        <p><strong>Quantity :</strong> {{ $item->quantity }}</p>
                                                        
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>-</td>
                                            <td>
                                                Belum ada transaksi
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $( document ).ready(function() {
        $(".update-order-confirm").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            console.log('udpate')
            $.ajax({
                url: '{{ url('people/order/update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                    status: 'paid'
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        
        $(".update-order-cancel").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            $.ajax({
                url: '{{ url('people/order/update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                    status: 'cancelled'
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        
        $(".update-order-received").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            $.ajax({
                url: '{{ url('people/order/update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                    status: 'received'
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
    })

</script>
@endsection
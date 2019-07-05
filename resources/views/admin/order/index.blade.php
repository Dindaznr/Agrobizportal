@extends('layouts.app-dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Order</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
    </div>
</div>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Transaksi Code</th>
            <th scope="col">Price</th>
            <th scope="col">Procedur</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $no => $order)
        <tr class="{{ $order->status === 'cancelled' ? 'table-danger' : ''}}">
            <th scope="row">1</th>
            <td>{{ $order->customer->name }}</td>
            <td>{{ $order->code }}</td>
            
            <td>Rp. {{ number_format( array_sum(array_map(function ($item) {
                return $item['price'];
            }, $order->orderItem->toArray())) ) }}</td>
            <td>
                @if($order->payment === 'cod')
                    Cash On Delivery
                @else
                    Bank Transfer
                @endif
            </td>
            <td>
                @if($order->status == 'open')
                    @if($order->payment != 'cod')
                    Menunggu Pembayaran Customer

                    @else
                    Customer Menunggu Pengiriman
                    
                    @endif
                @elseif($order->status == 'paid')
                    Menunggu Konfirmasi Pembayaran

                @elseif($order->status == 'paid_verified')
                    Customer Sudah Melakukan Pembayaran
                
                @elseif($order->status == 'pending')
                    Memproses Pesanan

                @elseif($order->status == 'sent')
                    Sedang Dikirim
                
                @elseif($order->status == 'received')
                    Sampai Tujuan

                @elseif($order->status == 'closed')
                    Selesai
                
                @elseif($order->status == 'cancelled')
                    Di Batalkan
                
                @endif
            </td>
            <td>
                @if($order->status !== 'cancelled' AND $order->status !== 'closed' AND $order->status !== 'sent')
                <button
                    id="btnGroupDropOption"
                    type="button"
                    class="btn btn-sm btn-outline-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDropOption">
                    @if($order->status == 'pending')
                    <a class="dropdown-item update-order-sent" data-id="{{ $order->id }}" href="#">
                        Pengiriman Pesanan
                    </a>
                    @endif
                    @if($order->status == 'paid')
                    <a class="dropdown-item update-order-sent" data-id="{{ $order->id }}" href="#">
                        Pengiriman Pesanan
                    </a>
                    @endif
                    @if($order->status == 'received')
                    <a class="dropdown-item update-order-close" data-id="{{ $order->id }}" href="#">
                        Close Up Pesanan
                    </a>
                    @endif
                    @if($order->status == 'open' OR $order->status == 'pending')
                    <a class="dropdown-item update-order-cancel" data-id="{{ $order->id }}" href="#">
                        Batalkan
                    </a>
                    @endif
                    <a class="dropdown-item "href="#"></a>
                </div>
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
    
@section('js')
<script type="text/javascript">
    $( document ).ready(function() {
        $(".update-order-sent").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            console.log('udpate to sent')
            $.ajax({
                url: '{{ url('admin/orders/update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                    status: 'sent'
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        
        $(".update-order-close").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            console.log('udpate to sent')
            $.ajax({
                url: '{{ url('admin/orders/update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                    status: 'closed'
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".update-order-cancel").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            console.log('udpate to cancelled')
            $.ajax({
                url: '{{ url('admin/orders/update') }}',
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
    })

</script>
@endsection
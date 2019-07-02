@extends('layouts.app')

@section('css')
@stop

@section('content')
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if(session('cart'))
	<table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $id => $details)
            <?php
                $total = null;
                $total += (int)$details['price'] * (int)$details['quantity'];
                $total += (int)$total;
            ?>
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="{{ asset('image/'. $details['image']) }}" alt="..." class="img-responsive" height="90" width="90"/>
                            </div>
                            <div class="col-sm-9">
                                <a href="{{ url('product/'. $details['slug']) }}">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">IDR {{ number_format( $details['price'] ) }}</td>
                    <td data-th="Quantity">
                        <input type="number" class="form-control text-center quantity" value="{{ $details['quantity'] }}">
                    </td>
                    <td data-th="Subtotal" class="text-center">{{ number_format($details['price'] * $details['quantity']) }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}" title="refresh"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}" title="delete"><i class="fa fa-trash-o"></i></button>								
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total {{ number_format( $total ) }}</strong></td>
            </tr>
            <tr>
                <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Kembali belanja</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total {{ number_format( $total ) }}</strong></td>
                <td><a href="#checkout" class="btn btn-success btn-block">Proses Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
        </tfoot>
    </table>
    @else
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-th="Product">
                    Belum ada product
                </td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total 0</strong></td>
            </tr>
            <tr>
                <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Kembali belanja</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total 0</strong></td>
                <!-- <td><a href="#" class="btn btn-success btn-block">Proses Checkout <i class="fa fa-angle-right"></i></a></td> -->
            </tr>
        </tfoot>
    </table>
    @endif
</div>

@endsection

@section('js')
<script type="text/javascript">
    $( document ).ready(function() {
        $(".update-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            console.log('udpate')
            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            console.log('remove')
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    })

</script>
@endsection
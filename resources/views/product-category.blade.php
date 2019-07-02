@extends('layouts.app')

@section('content')

@component('components.breadcumb',
    array(
        'category' => $category
    )

)
@endcomponent
<div class="container">
    <div class="row">
        
        @component('components.sidebar') @endcomponent

        <div class="col">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card" style="margin-bottom: 30px;">
                            <img class="card-img-top" src="{{ asset('image/'. $product->image) }}" height="190" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold;"><a href="{{ url('product/'. $product->slug) }}" title="View Product">{{ str_limit($product->name, 20) }}</a></h5>
                                <p class="card-text">{{ str_limit($product->description, 55) }}</p>
                                <div class="row">
                                    <div class="col">
                                        <strong style="text-align: center;">
                                            <small>IDR</small> {{ number_format($product->price) }}
                                        </strong>
                                    </div>
                                    <div class="col">
                                        <a href="{{ url('add-to-cart/'. $product->id .'?quantity=1') }}" class="btn btn-success btn-block">Tambah ke keranjang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</div>
@endsection

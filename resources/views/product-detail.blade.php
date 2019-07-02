@extends('layouts.app')

@section('content')
    
@component('components.breadcumb',
    array(
        'category' => $product->categories[0],
        'product' => $product
    )

)
@endcomponent
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-md-6 col-lg-5 item-photo">
            <img style="max-width:100%;" src="{{ asset('image/'. $product->image) }}" />
        </div>
        <div class="col-12 col-md-6" style="border:0px solid gray">
            <!-- Datos del vendedor y titulo del producto -->
            <h3>{{ $product->name }}</h3>    
            <!-- <h5 style="color:#337ab7">vendido por <a href="#">Samsung</a> · <small style="color:#337ab7">(5054 ventas)</small></h5> -->

            <!-- Precios -->
            <h6 class="title-price"><small>Harga</small></h6>
            <h3 style="margin-top:0px;">IDR {{ number_format($product->price) }}</h3>

            <!-- Detalles especificos del producto -->
            <!-- <div class="section">
                <h6 class="title-attr" style="margin-top:15px;" ><small>COLOR</small></h6>                    
                <div>
                    <div class="attr" style="width:25px;background:#5a5a5a;"></div>
                    <div class="attr" style="width:25px;background:white;"></div>
                </div>
            </div>
            <div class="section" style="padding-bottom:5px;">
                <h6 class="title-attr"><small>TYPE</small></h6>                    
                <div>
                    <div class="attr2">16 GB</div>
                    <div class="attr2">32 GB</div>
                </div>
            </div> -->
            <form method="GET" action="{{ url('add-to-cart/'. $product->id) }}">
                @csrf
                <div class="section" style="padding-bottom:20px;">
                    <h6 class="title-attr"><small> QUANTITY</small></h6>
                    <input value="1" type="number" name="quantity" min="1"/>
                </div>                

                <!-- Botones de compra -->
                <button type="submit" class="btn btn-success">
                    Tambah ke keranjang
                </button>
            </form>                                 
            <br>
            <h6><a href="{{ url('/') }}"><span class="glyphicon glyphicon-heart-empty" style="cursor:pointer;"></span>Kembali belanja</a></h6>
        </div>                              

        <div class="col-12 col-md-12">
            <ul class="menu-items">
                <li class="active">Deskripsi</li>
            </ul>
            <div style="width:100%;border-top:1px solid silver">
                <p style="padding:15px;">
                    {{ $product->description }}
                </p>
            </div>
        </div>		
    </div>
</div>
@endsection


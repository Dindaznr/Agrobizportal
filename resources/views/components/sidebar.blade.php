<div class="col-12 col-sm-3">
    <div class="card bg-light mb-3">
        <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories</div>
        <ul class="list-group category_block">
            @foreach ($categories as $category)
                <li class="list-group-item"><a href="{{ route('category', [$category->slug]) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="card bg-light mb-3">
        <div class="card-header bg-success text-white text-uppercase">Product Baru</div>
        
        <div class="card">
            <img class="card-img-top" src="{{ asset('image/'. $product->image) }}" height="200" alt="Card image cap">
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
</div>
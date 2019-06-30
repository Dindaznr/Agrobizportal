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
        <div class="card-body">
            <img class="img-fluid" src="{{ asset('image/'. $product->image) }}" />
            <h5 class="card-title">{{ str_limit($product->name, 30) }}</h5>
            <p class="card-text">{{ str_limit($product->description, 30) }}</p>
            <p class="bloc_left_price">Rp. {{ $product->price }}</p>
        </div>
    </div>
</div>
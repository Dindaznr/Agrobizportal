<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
            @if (isset($category) OR isset($product))
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                @if (isset($category))
                    <li class="breadcrumb-item"><a href="{{ url($category->slug) }}">{{ $category->name }}</a></li>
                @endif
                
                @if (isset($product))
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                @endif

                @if (isset($subcategory))
                    <li class="breadcrumb-item active" aria-current="page">{{ $subcategory->name }}</li>
                @endif
                </ol>
            @endif
            </nav>
        </div>
    </div>
</div>
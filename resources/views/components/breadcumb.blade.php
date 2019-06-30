<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                @if (isset($category))
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                @endif
                
                @if (isset($product))
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                @endif

                @if (isset($subcategory))
                <li class="breadcrumb-item active" aria-current="page">{{ $subcategory->name }}</li>
                @endif
            </ol>
            </nav>
        </div>
    </div>
</div>
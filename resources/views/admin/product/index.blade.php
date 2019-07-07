@extends('layouts.app-dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button
            onclick="window.location.href = '{{ route('products.create') }}';"
            class="btn btn-sm btn-outline-secondary">
            <span data-feather="plus"></span>
            Tambah Product Baru
        </button>
    </div>
</div>

<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $no => $product)
        <tr class="{{ $product->active ? '' : 'table-warning' }}">
            <th scope="row">{{ $no += 1 }}</th>
            <td><img src="{{ asset('image/'. $product->image) }}" height="100"/></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->slug }}</td>
            <td>Rp. {{ number_format($product->price) }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <button
                    title="edit"
                    onclick="window.location.href = '{{ route('products.edit', [$product->id]) }}';"
                    class="btn btn-sm btn-outline-secondary">
                    <span data-feather="edit-3"></span>
                </button>
                <a  data-id="{{ $product->id }}"
                    title="hapus"
                    class="btn btn-sm btn-outline-secondary hapus">
                    <span data-feather="trash-2"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
<script type="text/javascript">
    $( document ).ready(function() {
        $(".hapus").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('admin/products/') }}' + '/' + ele.attr("data-id"),
                method: "delete",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
    });

</script>
@endsection
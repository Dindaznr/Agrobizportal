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
                    onclick="window.location.href = '{{ route('categories.create') }}';"
                    class="btn btn-sm btn-outline-secondary">
                    <span data-feather="edit-3"></span>
                </button>
                <button
                    title="hapus"
                    onclick="window.location.href = '{{ route('categories.create') }}';"
                    class="btn btn-sm btn-outline-secondary">
                    <span data-feather="trash-2"></span>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
    
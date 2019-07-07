@extends('layouts.app-dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Product</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div onclick="window.location.href = '{{ route('products.index') }}';"
            class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Batal</button>
        </div>
    </div>
</div>
@if (session('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>
@endif
@if (session('errors'))
    <div class="alert alert-danger">
        <ol>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ol>
    </div>
@endif
<form method="post" action="{{ route('products.update', [$product->id]) }}" enctype="multipart/form-data" autocomplete="off">
@method('PUT')
@csrf
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $product->name) }}" placeholder="Product Name">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group col-md-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug', $product->slug) }}" placeholder="Product-slug">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $product->description) }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="featured_image">Product Image</label>
        <input type="file" name="featured_image" class="form-control-file" id="featured_image">
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ old('price', $product->price) }}" placeholder="1000" min="1000">
        </div>
        <div class="form-group col-md-3">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock', $product->stock) }}" placeholder="1" min="1">
        </div>
    </div>
    <label for="slug">Product Activated</label>
    <div class="form-row">
        <div class="form-group col-md-3">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="activeTrue" name="active" value="on" class="custom-control-input">
                <label class="custom-control-label" for="activeTrue">Ya</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="activeFalse" name="active" value="off" class="custom-control-input">
                <label class="custom-control-label" for="activeFalse">Tidak</label>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="category">Category</label>
            <select name="category" class="custom-control custom-select" id="category">
                <option value="" selected>-</option>
                @foreach($categories as $id => $category)   
                <option value="{{ $id }}" {{ $product->categories[0]->id == $id ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection

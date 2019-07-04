@extends('layouts.app-dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Category</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div onclick="window.location.href = '{{ route('categories.index') }}';"
            class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Batal</button>
        </div>
    </div>
</div>
<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
@csrf
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Category Name">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group col-md-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" id="slug" placeholder="Category slug">
        </div>
    </div>
    
    <label for="slug">Category Activated</label>
    <div class="form-row">
        <div class="form-group col-md-3">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="activeTrue" name="active" class="custom-control-input">
                <label class="custom-control-label" for="activeTrue">Ya</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="activeFalse" name="active" class="custom-control-input">
                <label class="custom-control-label" for="activeFalse">Tidak</label>
            </div>
        </div>
    </div>
    
    <div class="form-row">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection

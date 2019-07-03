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
@endsection

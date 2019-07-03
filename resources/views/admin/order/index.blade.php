@extends('layouts.app-dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Order</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
    </div>
</div>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>10</td>
            <td>
                <button
                    id="btnGroupDropOption"
                    type="button"
                    class="btn btn-sm btn-outline-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDropOption">
                    <a class="dropdown-item" href="#">Dropdown link</a>
                    <a class="dropdown-item" href="#">Dropdown link</a>
                </div>
            </td>
        </tr>
    </tbody>
</table>
@endsection
    
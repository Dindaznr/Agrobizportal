@section('css')
<style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu a::after {
  transform: rotate(-90deg);
  position: absolute;
  right: 6px;
  top: .8em;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-left: .1rem;
  margin-right: .1rem;
}
</style>
@endsection

@extends('layouts.app-dashboard')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Laporan</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <!-- <button class="btn btn-sm btn-outline-secondary">Share</button> -->
            <form method="get" action="{{ route('reports.delivery.export') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="name">Dari</label>
                        <input type="text" name="start_date" class="form-control start_date" id="name" placeholder="2019-12-20">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="name">Ke</label>
                        <input type="text" name="end_date" class="form-control end_date" id="name" placeholder="2019-12-20">
                    </div>
                </div>
                
                <div class="form-row">
                    <button
                        type="submit"
                        class="btn btn-sm btn-outline-secondary">
                        Export
                    </button>
                </div>
            </form>
        </div>
        <button id="btnGroupDropOptionFilter"
            type="button"
            class="btn btn-sm btn-outline-secondary dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span data-feather="calendar"></span>
            Filter Berdasarkan Tanggal
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDropOptionFilter">
            <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle">
                Berdasarkan tanggal
                </a>
                <div class="dropdown-menu">
                    <form method="get" action="{{ route('reports.delivery') }}">
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="name">Dari</label>
                                <input type="text" name="start_date" class="form-control start_date" id="name" placeholder="2019-12-20">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="name">Ke</label>
                                <input type="text" name="end_date" class="form-control end_date" id="name" placeholder="2019-12-20">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </li>
        </div>
    </div>
</div>

<h2 class="h3">Rekap Total Pengiriman</h2>
<div class="table-responsive">
    <table class="table table-sm text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Transaksi Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach($products as $no => $product)
            <tr>
                <td>{{ $no += 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ count($product->orderItem) }}</td>
                @php
                    $total += count($product->orderItem)
                @endphp
            </tr>
            @endforeach
            <tr>
                <th scope="row">Total: </th>
                <td colspan="1"></td>
                <td>{{ $total }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script>
$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
  }
  var $subMenu = $(this).next('.dropdown-menu');
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass('show');
  });


  return false;
});


</script>
@endsection
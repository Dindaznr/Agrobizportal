<div class="col-12 col-sm-3">
    <div class="card bg-light mb-3">
        <div class="card-header text-white bg-dark text-uppercase"><i class="fa fa-list"></i>{{ Auth::user()->customer->name }}</div>
        <ul class="list-group category_block">
            @request('people')
            <li class="list-group-item" style="background-color: #ddd;"><a href="#">Profile</a></li>
            @else
            <li class="list-group-item"><a href="{{ route('people.index') }}">Profile</a></li>
            @endrequest
            @request('people/order')
            <li class="list-group-item" style="background-color: #ddd;"><a href="#">Pembelian</a></li>
            @else
            <li class="list-group-item"><a href="{{ route('people.order') }}">Pembelian</a></li>
            @endrequest
        </ul>
    </div>
</div>
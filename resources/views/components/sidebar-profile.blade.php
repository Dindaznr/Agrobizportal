<div class="col-12 col-sm-3">
    <div class="card bg-light mb-3">
        <div class="card-header text-white bg-dark text-uppercase"><i class="fa fa-list"></i>{{ Auth::user()->customer->name }}</div>
        <ul class="list-group category_block">
            <li class="list-group-item"><a href="{{ route('people.index') }}">Profile</a></li>
            <li class="list-group-item"><a href="{{ route('people.order') }}">Pembelian</a></li>
        </ul>
    </div>
</div>
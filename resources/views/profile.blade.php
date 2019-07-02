@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @component('components.sidebar-profile') @endcomponent
        
        <div class="col">
            <div class="row">
                <div class="col-sm-8 offset-md-2">
                    <div class="card" style="width: 18rem;">
                        <div>
                            <img class="card-img-top" src="{{ Auth::user()->customer->image ? asset('/image/'. Auth::user()->customer->image) : asset('/image/component/person-placeholder.png') }}" alt="Image Profile">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ Auth::user()->customer->name }}</h5>
                            <p class="card-text">{{ Auth::user()->address->name }}</p>
                            <a href="#" class="btn btn-primary">Ubah profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

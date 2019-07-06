@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="min-height: 550px; margin-top: 30px;">
        
        @component('components.sidebar-profile') @endcomponent
        
        <div class="col">
            <div class="row">
                <div class="col-sm-6 offset-md-2">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-4 offset-md-4">
                                <img class="card-img-top" src="{{ Auth::user()->customer->image ? asset('/image/'. Auth::user()->customer->image) : asset('/image/component/person-placeholder.png') }}" alt="Image Profile">
                            </div>
                        </div>
                        <div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ Auth::user()->customer->name }}</h5>
                            <p class="card-text">{{ Auth::user()->customer->address->name }}</p>
                            <!-- <a href="#" class="btn btn-primary">Ubah profile</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

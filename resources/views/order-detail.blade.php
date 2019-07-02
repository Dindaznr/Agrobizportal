@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @component('components.sidebar-profile') @endcomponent
        
        <div class="col">
            <div class="row">
                <div style="min-height: 500px;">
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

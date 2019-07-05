@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="min-height: 550px; margin-top: 30px;">
        
        @component('components.sidebar-profile') @endcomponent
        
        <div class="col">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <form method="post" action="{{ url('/address') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="alis">Alias</label>
                                        <input type="text" name="alis" class="form-control" id="alis" placeholder="Rumah, Kantor, Sekolah">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Alamat detail">
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="city">Kota</label>
                                        <input type="text" name="city" class="form-control" id="city" placeholder="Ibu Kota">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="province">Province</label>
                                        <input type="text" name="province" class="form-control" id="province" placeholder="Provinsi">
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="district">Kecamatan</label>
                                        <input type="text" name="district" class="form-control" id="district" placeholder="Kecamatan">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        .dropdown:hover>.dropdown-menu {
            display: block;
        }
    </style>
    @yield('css')
</head>
<body>
    <div id="app">
        

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Agrobizportal commerce</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
                    <ul class="navbar-nav m-auto">
                        @request('/')
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                Home <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                Home <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @endrequest
                        
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownCategory">
                                @foreach($categories as $category)
                                   <a class="dropdown-item" href="{{ route('category', [$category->slug]) }}">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </li>

                        @if(Auth::user())
                            @customer
                                @request('people/order')
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Pesanan Saya</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('people.order') }}">Pesanan Saya</a>
                                </li>
                                @endrequest
                            @endcustomer
                        @endif

                    </ul>

                    <form class="form-inline my-2 my-lg-0" role="search" method="get" action="{{ route('product.search') }}">
                        <div class="input-group input-group-sm">
                            <input type="search" name="search" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search..." autocomplete="off" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-number">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                        <a class="btn btn-success btn-sm ml-3" href="{{ url('cart') }}">
                            <i class="fa fa-shopping-cart"></i> Cart
                            @if(Auth::user())
                                @if(session('cart'))
                                <span class="badge badge-light">{{ count(session('cart')) }}</span>
                                @endif
                            @endif
                        </a>

                     <!-- Right Side Of Navbar -->
                     <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @admin
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                @endadmin
                                
                                @seller
                                    {{ Auth::user()->seller->name }} <span class="caret"></span>
                                @endseller

                                @customer
                                    {{ Auth::user()->customer->name }} <span class="caret"></span>
                                @endcustomer
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    @admin
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                    @endadmin
                                    
                                    @seller
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                    @endseller
                                    
                                    @customer
                                    <a class="dropdown-item" href="{{ route('people.index') }}">Profile</a>
                                    @endcustomer
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-4 col-xl-3">
                        <h5>Tentang</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <p class="mb-0">
                        Agrobizportal adalah website-platform pertama di Budi Luhur dan Sekitarnya yang menawarkan transaksi jual beli online yang menyenangkan, dan terpercaya via website.
                        </p>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                        <h5>Layanan Pelanggan</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><a href="">Bantuan</a></li>
                            <li><a href="">Hubungi Kami</a></li>
                        </ul>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                        <h5>Jelajahi</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><a href="">Tentang Kami</a></li>
                            <li><a href="">Kebijak Privasi</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3">
                        <h5>Contact</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-home mr-2"></i> Agrobizportal</li>
                            <li><i class="fa fa-envelope mr-2"></i> support@agrobizportal.com</li>
                            <li><i class="fa fa-phone mr-2"></i> +62 858-1447-8853</li>
                        </ul>
                    </div>
                    <div class="col-12 copyright mt-3">
                        <p class="float-left">
                            <a href="#">Back to top</a>
                        </p>
                        <!-- <p class="text-right text-muted">created with <i class="fa fa-heart"></i> by <a href="https://t-php.fr/43-theme-ecommerce-bootstrap-4.html"><i>t-php</i></a> | <span>v. 1.0</span></p> -->
                    </div>
                </div>
            </div>
        </footer>
    </div>
@yield('js')
</body>
</html>

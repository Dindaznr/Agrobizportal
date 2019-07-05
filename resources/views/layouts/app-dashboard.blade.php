
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.1/assets/img/favicons/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

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

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      @admin
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Administrator {{ Auth::user()->email }}</a>
      @endadmin

      @seller
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{ config('app.name', 'Laravel') }} | {{ Auth::user()->seller->name }}</a>
      @endseller
      
      @customer
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{ config('app.name', 'Laravel') }} | {{ Auth::user()->customer->name }}</a>
      @endcustomer
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              @seller
              <li class="nav-item">
                @request('admin')
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                @else
                  <a class="nav-link" href="{{ route('dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                @endrequest
              </li>

              <li class="nav-item">
                @request('admin/orders')
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Orders <span class="sr-only">(current)</span>
                  </a>
                @else
                  <a class="nav-link" href="{{ route('orders.index') }}">
                    <span data-feather="home"></span>
                    Orders <span class="sr-only">(current)</span>
                  </a>
                @endrequest
              </li>
              <li class="nav-item">
                @request('admin/categories')
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Categories <span class="sr-only">(current)</span>
                  </a>
                @else
                  <a class="nav-link" href="{{ route('categories.index') }}">
                    <span data-feather="home"></span>
                    Categories <span class="sr-only">(current)</span>
                  </a>
                @endrequest
              </li>
              <li class="nav-item">
                @request('admin/products')
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Products <span class="sr-only">(current)</span>
                  </a>
                @else
                  <a class="nav-link" href="{{ route('products.index') }}">
                    <span data-feather="home"></span>
                    Products <span class="sr-only">(current)</span>
                  </a>
                @endrequest
              </li>
              @endseller

              @admin
              <li class="nav-item">
                @request('admin')
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                @else
                  <a class="nav-link" href="{{ route('dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                @endrequest
              </li>
              
              <li class="nav-item">
                @request('admin/orders/payment')
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Pembayaran <span class="sr-only">(current)</span>
                  </a>
                @else
                  <a class="nav-link" href="{{ route('orders.payment') }}">
                    <span data-feather="home"></span>
                    Pembayaran <span class="sr-only">(current)</span>
                  </a>
                @endrequest
              </li>
              
              <li class="nav-item">
                @request('admin/customers')
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Customers <span class="sr-only">(current)</span>
                  </a>
                @else
                  <a class="nav-link" href="{{ route('customers.index') }}">
                    <span data-feather="home"></span>
                    Customers <span class="sr-only">(current)</span>
                  </a>
                @endrequest
              </li>
              @endadmin
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Data Reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="bar-chart-2"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              @seller
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Laporan Penjualan
                  </a>
                </li>
              @endseller
              @admin
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Laporan
                  </a>
                </li>
              @endadmin
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          @yield('content')
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script> -->

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    @yield('js')
  </body>
</html>

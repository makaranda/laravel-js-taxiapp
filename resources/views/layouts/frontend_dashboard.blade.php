<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <title>Taxi App | Esoft ASE Assignment</title>
        @include('libraries.frontend.styles')
        @stack('css')
    </head>
  <body>
    @include('components.frontend.nav')
    <div id="overlay" style="display: block;">
        <div class="loader"></div>
    </div>
    @php
        if(Auth::user()->role == 'customer'){
            $personTitle = 'Customer';
            $homeRoute = route('customer.dashboard');
        }else{
            $personTitle = 'Driver';
            $homeRoute = route('driver.dashboard');
        }
    @endphp
    <div class="site-breadcrumb" style="background: url({{ url('public/assets/img/breadcrumb/01.jpg') }})">
        <div class="container">
           <h2 class="breadcrumb-title">{{ $personTitle }} Dashboard</h2>
           <ul class="breadcrumb-menu">
              <li><a href="{{ $homeRoute }}">Home</a></li>
              <li class="active">{{ $personTitle }} Dashboard</li>
           </ul>
        </div>
     </div>
     <div class="user-profile py-120">
        <div class="container">
           <div class="row">
              <div class="col-lg-3">
                @include('components.frontend.user_profile')
              </div>
              <div class="col-lg-9">
                @yield('content')
              </div>
            </div>
        </div>
     </div>
        @include('components.frontend.footer')
        @include('libraries.frontend.scripts')
        @stack('scripts')
  </body>
</html>

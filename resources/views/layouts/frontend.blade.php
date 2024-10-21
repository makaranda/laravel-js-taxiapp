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
        @yield('content')

        @include('components.frontend.footer')
        @include('libraries.frontend.scripts')
        @stack('scripts')
  </body>
</html>

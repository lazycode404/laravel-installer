<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Custom Installer') }}</title>
    <link rel="icon" href="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('styles')
  </head>

  <body>
    <main class="main container mt-5">
        <div class="mb-5 h1 text-center text-primary">
            Laravel Web Installer
        </div>

        @yield('content')
    </main>
  </body>
  @stack('scripts')
</html>

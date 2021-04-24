<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/font.css')}}">

    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

    <title>@yield('title')</title>
  </head>
  <body>

    @yield('content')


    <!-- Optional JavaScript -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/font-awesome.js')}}"></script>
    @yield('more-js')
  </body>
</html>
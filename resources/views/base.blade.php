<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ app('url')->to('/') }}">

    <title>Laravel</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}" />
</head>
<body class="pt-5">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">CodeLine</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container" id="app">
    <div class="row">

        {{----}}
        {{--<div class="col-lg-3 mt-5">--}}
            {{--<div class="bg-white mt-5 mb-5 p-3 shadow-sm">--}}
                {{--@yield('sidebar')--}}
            {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.col-lg-3 -->--}}


        <div class="col">
            <h1 class="my-4">@yield('title')</h1>

            <div class="bg-white mb-5 p-3 shadow-sm">
                @yield('content')
            </div>

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
    </div>
    <!-- /.container -->
</footer>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>


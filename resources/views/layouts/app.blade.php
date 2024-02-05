<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="@yield('keywords.page')" />
    <meta name="description" content="@yield('description.page')" />
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset(template()) }}">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('js/currencydate.js') }}"></script>
    <script src="{{ asset('js/allsorttoblock.js') }}"></script>
    <script src="{{ asset('js/responseajax.js') }}"></script>
    <script src="{{ asset('js/draw.js') }}"></script>

    <title>@yield('title.page', config('app.name'))</title>
</head>

{{--{{dd(empty(template('body')))}}--}}
<body>
<div class="d-flex flex-column justify-content-between min-vh-100">

@include('modules.header')
@include('modules.message')

<main class="flex-grow-1 py-3">
    <div class="wrapper">
        <div class="container">
            @yield("content")
        </div>
    </div>
</main>

@include('modules.footer')

</div>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>

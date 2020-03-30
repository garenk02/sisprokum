<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="-1" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<meta name="csrf-token" content="{{ csrf_token() }}" />-->
<title>{{ config('app.initial') }} | @yield('title')</title>
<!-- Favicon -->
<link href="{{ asset('images/logo/favicon.png') }}" rel="icon" type="image/png">
<!-- Bootstrap -->
<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- Waves Effect Css -->
<link href="{{ asset('vendors/node-waves/waves.css') }}" rel="stylesheet" />
<!-- Sweet Alert Css -->
<link href="{{ asset('vendors/sweetalert/sweetalert.css') }}" rel="stylesheet" />	
@section('header')
@show
<!-- Theme Style -->
<link href="{{ asset('css/theme.min.css') }}" rel="stylesheet">
<!-- Custom Style -->
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
@yield('content')

<!-- jQuery -->
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Waves Effect Plugin Js -->
<script src="{{ asset('vendors/node-waves/waves.js') }}"></script>
<!-- Sweet Alert Js -->
<script src="{{ asset('vendors/sweetalert/sweetalert.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
@section('footer')
@show
<!-- Theme Scripts -->
<script src="{{ asset('js/theme.min.js') }}"></script>
<!-- Custom Scripts -->
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
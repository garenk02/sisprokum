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
<!-- Fonts -->
<link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!--<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- NProgress -->
<link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
<!-- iCheck -->
<link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
<!-- bootstrap-progressbar -->
<link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
<!-- Select2 -->
<link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<!-- Waves Effect Css -->
<link href="{{ asset('vendors/node-waves/waves.css') }}" rel="stylesheet" />
<!-- Sweet Alert Css -->
<link href="{{ asset('vendors/sweetalert/sweetalert.css') }}" rel="stylesheet" />	
<!-- Preloader Css -->
<link href="{{ asset('vendors/material-design-preloader/md-preloader.css') }}" rel="stylesheet" />
<!-- bootstrap-material-datetimepicker Css -->
<link href="{{ asset('vendors/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
<!-- Bootstrap-wysiwyg -->
<link href="{{ asset('vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
<!-- Switchery -->
<link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
<!-- Starrr -->
<link href="{{ asset('vendors/starrr/dist/starrr.css') }}" rel="stylesheet">
<!-- jsTree -->
<link href="{{ asset('vendors/vakata-jstree/dist/themes/default/style.min.css') }}" rel="stylesheet">
@section('header')
@show
<!-- Theme Style -->
<link href="{{ asset('css/theme.min.css') }}" rel="stylesheet">
<!-- Custom Style -->
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="mobile">
<!-- Page Loader -->
<div class="page-loader-wrapper">
	<noscript>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa fa-bullhorn"></i>
		<span class="icon-text">
		{!! trans('site.error_noscript') !!}
		</span>
	</div>		
	</noscript>
	<div class="loader">
		<h1>{{ config('app.initial') }}</h1>
		<h2>{{ config('app.name') }}</h2>
		<div class="md-preloader pl-size-md">
			<svg version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			  viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
			 <path fill="#1ABB9C" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3
			  c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z">
				  <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
			  </path>
			 <path fill="#1ABB9C" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7
			  c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z">
				  <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="-360 50 50" repeatCount="indefinite" />
			  </path>
			 <path fill="#1ABB9C" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5
			  L82,35.7z">
				  <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
			  </path>
			</svg>
		</div>
	</div>
</div>
<!-- #END# Page Loader -->
<div class="container body">
	<div class="main_container">
@if(Session::has('result'))
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<i class="fa fa-check-circle"></i>
			<span class="icon-text">{{ Session::get('result') }}</span>
		</div>
@endif
@if($errors->any())
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<i class="fa fa-bullhorn"></i>
			<span class="icon-text">
			@foreach($errors->all() as $error)
				{{ $error }}<br/>
			@endforeach
			</span>
		</div>
@endif
	
@yield('content')
	  </div>
	</div>
</div>
<!-- jQuery -->
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('js/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/datepicker/daterangepicker.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Waves Effect -->
<script src="{{ asset('vendors/node-waves/waves.js') }}"></script>
<!-- Sweet Alert Js -->
<script src="{{ asset('vendors/sweetalert/sweetalert.min.js') }}"></script>
<!-- bootstrap-material-datetimepicker -->
<script src="{{ asset('vendors/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{ asset('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('vendors/google-code-prettify/src/prettify.js') }}"></script>
<!-- jQuery Tags Input -->
<script src="{{ asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
<!-- Switchery -->
<script src="{{ asset('vendors/switchery/dist/switchery.min.js') }}"></script>
<!-- Parsley -->
<script src="{{ asset('vendors/parsleyjs/dist/parsley.min.js') }}"></script>
<!-- Autosize -->
<script src="{{ asset('vendors/autosize/dist/autosize.min.js') }}"></script>
<!-- jQuery autocomplete -->
<script src="{{ asset('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
<!-- starrr -->
<script src="{{ asset('vendors/starrr/dist/starrr.js') }}"></script>
<!-- jsTree -->
<script src="{{ asset('vendors/vakata-jstree/dist/jstree.min.js') }}"></script>

<script language="javascript">
$.ajaxSetup({
    headers: {
        'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

@section('footer')
@show
<!-- Theme Scripts -->
<script src="{{ asset('js/theme.min.js') }}"></script>
<!-- Custom Scripts -->
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
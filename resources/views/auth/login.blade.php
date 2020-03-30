@extends('layouts.default')

@section('title', 'Sistem Informasi Persuratan Dinas')

@section('header')
<!-- NProgress -->
<link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
<!-- iCheck -->
<link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
<!-- Animate.css -->
<link href="{{ asset('vendors/animate.css/animate.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="login" class="row clearfix login">
  <div class="login_wrapper">
	<div class="animate form login_form">
	  <p class="text-center"><img src="{{ asset('images/logo/logo.png') }}" width="150px"></p>
	  <section class="login_content">
		{{ Form::open(['id' => 'login', 'method' => 'post']) }} 
		<h1>{{ strtoupper(config('app.name')) }}</h1>
		<div class="form-group">
			<div class="col-xs-12">
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
			</div>
		</div>		
		<div class="form-group">
			<div class="col-xs-12">
				<input type="text" name="username" class="form-control" placeholder="{{ trans('site.username') }}" required/>
			</div>
			<div class="col-xs-12">
				<input type="password" name="password" class="form-control" placeholder="{{ trans('site.password') }}" required/>
			</div>
			<div class="col-xs-12">
				<p>
				<input type="checkbox" name="rememberme" class="flat">
				<label>{{ trans('site.remember') }}</label>
				</p>
			</div>		  
			<div class="col-xs-12">
				<button type="submit" class="btn btn-success submit">{{ trans('site.login') }}</button>
			</div>
		</div>	
		<div class="clearfix"></div>
		<div class="separator">
			<div>
			<p>{{ config('app.name') }} &copy; {{ date('Y') }}</p>	
			<p>{{ Hash::make('admin123') }}</p>
			</div>
		</div>
	  {{ Form::close() }} 
 	  </section>
	</div>
  </div>
</div>
@endsection

@section('footer')
<!-- iCheck -->
<script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
<script language="javascript">
$(document).ready(function() 
{
	$('body').css('background', '#f7f7f7');
	$('#login').iCheck({checkboxClass: 'icheckbox_flat-green', radioClass: 'iradio_flat-green'});
});
</script>
@endsection


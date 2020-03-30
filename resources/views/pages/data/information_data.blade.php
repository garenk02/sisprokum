@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
<!-- Switchery -->
<link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ trans('site.data_detail') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['information_id']) ? ['information.update', $data['information_id']] : ['information.create', null], 'action'=>'InformationController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('information_id', null) }}
			<div class="row clearfix">
				<div class="form-group form-line">
					<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label('Tanggal Publikasi') }}</div>
					<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['information_date_text'] }}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label('Pengunggah') }}</div>
					<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['information_name'] }}</div>
				</div>				
				<div class="form-group form-line">
					<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label('Judul Informasi') }}</div>
					<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['information_title'] }}</div>
				</div>				
				<div class="form-group form-line">
					<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label('Deskripsi') }}</div>
					<div class="col-md-10 col-sm-9 col-xs-8">{!! $data['information_note'] !!}</div>
				</div>							
				<div class="form-group form-line">
					<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label('File Lampiran') }}</div>
					<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['information_file'] }}</div>
				</div>
				<div class="form-group">
					<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.status')) }}</div>
					<div class="col-md-10 col-sm-9 col-xs-8">{!! $data['information_status_label'] !!}</div>
				</div>		
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
					<button type="button" id="edit" class="btn btn-sm btn-success m-t-15 waves-effect">{{ trans('site.update') }}</button>
					<button type="button" id="back" class="btn btn-sm btn-primary m-t-15 waves-effect">{{ trans('site.cancel') }}</button>
				</div>
			</div>
			{{ Form::close() }}
		  </div>
		</div>
	</div>
</div>
@endsection


@section('footer')
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
	
<script language="javascript">
$(document).ready(function() {

});	
</script>
@endsection
@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
<!-- Bootstrap-wysiwyg -->
<link href="{{ asset('vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
<!-- Select2 -->
<link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<!-- Switchery -->
<link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
<!-- Starrr -->
<link href="{{ asset('vendors/starrr/dist/starrr.css') }}" rel="stylesheet">	
@endsection

@section('content')
<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ trans('site.data_editor') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['setting_id']) ? ['setting.update', $data['setting_id']] : ['setting.create', null], 'action'=>'SettingController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('setting_id', null) }}
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.setting_name') }} <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('setting_name', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.code') }} <span style="color:red">*</span></label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::text('setting_code', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.value') }}</label>							
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('setting_value', null, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.description') }}</label>							
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::textarea('setting_description', null, ['class'=>'form-control']) }}
				</div>
			</div>					
			<div class="form-group">
				<div class="col-md-3 col-md-offset-2 col-sm-6 col-sm-offset-3 col-xs-12">
					<em><span style="color:red">*</span> <small>{{ trans('site.required') }}</small></em>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
					<button type="submit" id="save" class="btn btn-success m-t-15 waves-effect"><i class="fa fa-save"></i> {{ trans('site.save') }}</button>
					<button type="button" id="back" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-undo"></i> {{ trans('site.cancel') }}</button>
				</div>
			</div>
			{{ Form::close() }}
		  </div>
		</div>
	</div>
</div>
@endsection


@section('footer')
<script language="javascript">
$(document).ready(function() {

});	
</script>
@endsection

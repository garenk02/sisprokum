@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['menu_id']) ? ['menu.update', $data['menu_id']] : ['menu.create', null], 'action'=>'MenuController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('menu_id', null) }}
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.menu_name') }} <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('menu_name', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.icon') }}</label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::text('menu_icon', null, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.image') }}</label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::file('image', ['class'=>'form-control']) }}
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.position') }}</label>							
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::number('menu_position', null, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.status') }}</label>							
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div><label>
					{{ Form::checkbox('menu_status', 'enable', !empty($data['menu_status']) && $data['menu_status'] == "enable"  ? true : false, ['class'=>'js-switch']) }} {{ trans('site.enable') }}
					</label></div>
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

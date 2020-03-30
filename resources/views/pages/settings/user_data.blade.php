@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['user_id']) ? ['user.update', $data['user_id']] : ['user.create', null], 'action'=>'UserController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('user_id', null) }}
			<div class="row clearfix">
				<div class="col-sm-10 col-xs-12">
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.name')) }}</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['user_name'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.pin')) }}</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['user_pin'] }}</div>
					</div>		
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.email')) }}</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['user_email'] }}</div>
					</div>					
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_structure')) }}</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['structure_name'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_name')) }} 1</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['user_post_type_name'] }} {{ $data['post_name'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_unit')) }} 1</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['post_unit'] }}</div>
					</div>			
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_name')) }} 2</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['user_post_type_name_1'] }} {{ $data['post_name_1'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_unit')) }} 2</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['post_unit_1'] }}</div>
					</div>		
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_name')) }} 3</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['user_post_type_name_2'] }} {{ $data['post_name_2'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_unit')) }} 3</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['post_unit_2'] }}</div>
					</div>		
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_name')) }} 4</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['user_post_type_name_3'] }} {{ $data['post_name_3'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_unit')) }} 4</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['post_unit_3'] }}</div>
					</div>		
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_name')) }} 5</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['user_post_type_name_4'] }} {{ $data['post_name_4'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.post_unit')) }} 5</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['post_unit_4'] }}</div>
					</div>								
					<div class="form-group form-line">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.level')) }}</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{{ $data['level_name'] }}</div>
					</div>			
					<div class="form-group form-line">
						<div class="col-xs-12">{{ Form::label(trans('site.modules')) }}</div>
						<div class="col-xs-12">{{ Form::bsModule('user_modules', $module_options, $module_actions, $data['user_modules'], ['disabled'=>'']) }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-2 col-sm-3 col-xs-4">{{ Form::label(trans('site.status')) }}</div>
						<div class="col-md-10 col-sm-9 col-xs-8">{!! $data['user_status_label'] !!}</div>
					</div>		
				</div>
				<div class="col-sm-2 col-xs-12">
					<div class="thumbnail">
					<b>Foto</b>
					<img src="{{ asset('images/users/'.$data['user_photo']) }}">
					</div>
					<div class="thumbnail">
					<b>Tanda Tangan</b>
					<img src="{{ asset('images/users/'.$data['user_signature']) }}">
					</div>					
					<div class="thumbnail">
					<b>Paraf</b>
					<img src="{{ asset('images/users/'.$data['user_initials']) }}">
					</div>					
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
<script language="javascript">
$(document).ready(function() {

});	
</script>
@endsection
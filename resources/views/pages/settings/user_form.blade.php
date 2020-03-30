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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['user_id']) ? ['user.update', $data['user_id']] : ['user.create', null], 'action'=>'UserController@save', 'class'=>'form-horizontal form-label-left', 'files'=>true]) }}
			{{ Form::hidden('user_id', null) }}
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.name') }} <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('user_name', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.pin') }} <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('user_pin', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.email') }} <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('user_email', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.password') }} {!! empty($data['user_id']) ? '<span style="color:red">*</span>' : '' !!}</label>							
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::password('password', (empty($data['user_id']) ? ['class'=>'form-control','required'=>true] : ['class'=>'form-control'])) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.repassword') }} {!! empty($data['user_id']) ? '<span style="color:red">*</span>' : '' !!}</label>							
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::password('password_confirmation', (empty($data['user_id']) ? ['class'=>'form-control','required'=>true] : ['class'=>'form-control'])) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.level') }} <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('user_level', $level_options, null, ['id'=>'level','class'=>'form-control select2_single disable-switch','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.post') }} 1</label>	
@if (!empty($data['user_post_type']))
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::hidden('user_post', null) }}
				{{ Form::text('post_name', !empty($data['post_name']) ? $data['post_name'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>		
				<div class="col-md-2 col-sm-3 col-xs-12">
				{{ Form::hidden('user_post_type', null) }}
				{{ Form::text('post_type', !empty($data['user_post_type']) ? $data['user_post_type_name'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>
@else
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('user_post', $post_options, null, ['class'=>'form-control select2_single']) }}
				</div>		
@endif
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.post') }} 2</label>		
@if (!empty($data['user_post_type_1']))
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::hidden('user_post_1', null) }}
				{{ Form::text('post_name_1', !empty($data['post_name_1']) ? $data['post_name_1'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>		
				<div class="col-md-2 col-sm-3 col-xs-12">
				{{ Form::hidden('user_post_type_1', null) }}
				{{ Form::text('post_type_1', !empty($data['user_post_type_1']) ? $data['user_post_type_name_1'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>
@else
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('user_post_1', $post_options, null, ['class'=>'form-control select2_single']) }}
				</div>		
@endif
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.post') }} 3</label>		
@if (!empty($data['user_post_type_2']))
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::hidden('user_post_2', null) }}
				{{ Form::text('post_name_2', !empty($data['post_name_2']) ? $data['post_name_2'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>		
				<div class="col-md-2 col-sm-3 col-xs-12">
				{{ Form::hidden('user_post_type_2', null) }}
				{{ Form::text('post_type_2', !empty($data['user_post_type_2']) ? $data['user_post_type_name_2'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>
@else
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('user_post_2', $post_options, null, ['class'=>'form-control select2_single']) }}
				</div>		
@endif
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.post') }} 4</label>		
@if (!empty($data['user_post_type_3']))
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::hidden('user_post_3', null) }}
				{{ Form::text('post_name_3', !empty($data['post_name_3']) ? $data['post_name_3'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>		
				<div class="col-md-2 col-sm-3 col-xs-12">
				{{ Form::hidden('user_post_type_3', null) }}
				{{ Form::text('post_type_3', !empty($data['user_post_type_3']) ? $data['user_post_type_name_3'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>
@else
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('user_post_3', $post_options, null, ['class'=>'form-control select2_single']) }}
				</div>		
@endif
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.post') }} 5</label>		
@if (!empty($data['user_post_type_4']))
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::hidden('user_post_4', null) }}
				{{ Form::text('post_name_4', !empty($data['post_name_4']) ? $data['post_name_4'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>		
				<div class="col-md-2 col-sm-3 col-xs-12">
				{{ Form::hidden('user_post_type_4', null) }}
				{{ Form::text('post_type_4', !empty($data['user_post_type_4']) ? $data['user_post_type_name_4'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>
@else
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('user_post_4', $post_options, null, ['class'=>'form-control select2_single']) }}
				</div>		
@endif
			</div>				
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.head') }}</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('user_head[]', $post_options, null, ['class'=>'form-control select2_multiple','multiple'=>'multiple']) }}
				</div>
			</div>		
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Digantikan oleh</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::hidden('user_replace_id', null) }}
				{{ Form::hidden('user_replace_type', null) }}				
				{{ Form::text('user_replace_name', !empty($data['user_replace_name']) ? $data['user_replace_name'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>	
@if (!empty($data['user_replace_id']) && !empty($data['user_replace_type']))
				<div class="col-md-2 col-sm-3 col-xs-12">
				{{ Form::text('user_replace_type_name', !empty($data['user_replace_type_name']) ? $data['user_replace_type_name'] : "", ['class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()']) }}
				</div>
@endif
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.photo') }}</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::file('photo', ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.signature') }}</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::file('signature', ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.initials') }}</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::file('initial', ['class'=>'form-control']) }}
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.modules') }}</label>		
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::bsModule('user_modules', $module_options, $module_actions, !empty($data['user_modules']) ? $data['user_modules'] : []) }}
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">{{ trans('site.status') }}</label>		
				<div class="col-md-4 col-sm-6 col-xs-12">	
				{{ Form::select('user_status', $status_options, null, ['class'=>'form-control select2_single']) }}
				</div>
			</div>	
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-3 col-md-offset-2 col-sm-6 col-sm-offset-3 col-xs-12">
					<em><span style="color:red">*</span> <small>{{ trans('site.required') }}</small></em>
				</div>
			</div>
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
$(document).ready(function() 
{
	$('#level').on('change', function() {
		var data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['id'] = $('#level').val();
		
		$.ajax({
			url: "{{ url('level/modules') }}",
			method: "POST",
			dataType: "json",
			data: data,
		})
		.done(function(data) 
		{	
		//	$('input:checkbox').prop('checked', false);
			$('.flat').iCheck('uncheck');
			
			$.each(data, function(id, actions) {
		//		$('#module_' + id).prop('checked', true);
				$('#module_' + id).iCheck('check');
				$.each(actions, function(index, action) {
					$('#module_' + id + '_' + action).iCheck('check');
				});
			});
		});			
	});	
});	
</script>
@endsection

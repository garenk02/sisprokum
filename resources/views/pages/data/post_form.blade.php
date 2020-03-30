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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['pos_id']) ? ['post.update', $data['pos_id']] : ['post.create', null], 'action'=>'PostController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('pos_id', null) }}
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Pejabat Pelaksana <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('pos_user_id', $user_options, null, !empty($data['pos_id']) ? ['id'=>'user','class'=>'form-control select2_single disable-switch','disabled'=>true] : ['id'=>'user','class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Jabatan Limpahan <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('pos_post_id', $post_options, !empty($data['pos_post_id']) ? $data['pos_post_id'] : "", !empty($data['pos_id']) ? ['id'=>'post','class'=>'form-control select2_single disable-switch','disabled'=>true] : ['id'=>'post','class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tipe Jabatan <span style="color:red">*</span></label>		
				<div class="col-md-4 col-sm-6 col-xs-12">
				{{ Form::select('pos_post_type', $post_type_options, null, ['id'=>'type','class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Masa Aktif <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-6 col-xs-12">
				{{ Form::bsDaterange('pos_date', !empty($data['pos_start']) ? $data['pos_start'] : "", !empty($data['pos_end']) ? $data['pos_end'] : "", ['id'=>'pos_date','required'=>true]) }}
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
$(document).ready(function() 
{

});	
</script>
@endsection

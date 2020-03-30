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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['archive_id']) ? ['archive.update', $data['archive_id']] : ['archive.create', null], 'action'=>'ArchiveController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('archive_id', null, ['id'=>'archive_id']) }}		
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Klasifikasi <span style="color:red">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('archive_name', null, ['class'=>'form-control','required'=>true]) }} 
				</div>
			</div>					
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tampil Pada Menu</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div><label>
					{{ Form::checkbox('archive_visibility', 'yes', !empty($data['archive_visibility']) && $data['archive_visibility'] == "yes"  ? true : false, ['class'=>'js-switch']) }} Ya
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
					<button type="button" id="save" class="btn btn-success m-t-15 waves-effect"><i class="fa fa-save"></i> {{ trans('site.save') }}</button>
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
	$('#save').click(function() 
	{	
		var hasError = false;
		
		$('[required]').each(function() {
			if (this.value.trim() == ""){ 
				hasError = true;
				$(this).attr('placeholder', "{{ trans('site.error_required') }}");
				$(this).focus();				
				swal("Error!", "{{ trans('site.error_required') }}", "error");							
			}
		});		
				
		if (hasError == false){
			$('#form').submit();
		}

		return false;		
	});
});	
</script>
@endsection
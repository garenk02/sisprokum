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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['calendar_id']) ? ['calendar.update', $data['calendar_id']] : ['calendar.create', null], 'action'=>'CalendarController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('calendar_id', null, ['id'=>'calendar_id']) }}		
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Data Kegiatan</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Pemilik Kegiatan</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('calendar_user', $post_options, null, ['id'=>'calendar_user','class'=>'form-control select2_single']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Kegiatan <span style="color:red">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('calendar_title', null, ['class'=>'form-control','required'=>true]) }} 
				</div>
			</div>					
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Deskripsi <span style="color:red">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::bsEditor('calendar_description', !empty($data['calendar_description']) ? $data['calendar_description'] : null) }}
				</div>
			</div>	
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Data Tambahan</h6>
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal/Waktu Mulai <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-6 col-xs-12">
				{{ Form::bsDatetime('calendar_start', !empty($data['calendar_start']) ? $data['calendar_start'] : "", ['required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal/Waktu Akhir <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-6 col-xs-12">
				{{ Form::bsDatetime('calendar_end', !empty($data['calendar_end']) ? $data['calendar_end'] : "", ['required'=>true]) }}
				</div>
			</div>		
			<fieldset id="share" style="display: {{ !empty($data['calendar_public']) && $data['calendar_public'] == 'yes' ? 'none' : 'block' }}">
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Berbagi Kepada</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('calendar_share[]', $post_list, !empty($data['calendar_share']) ? $data['calendar_share'] : [], ['multiple'=>true, 'class'=>'form-control select2_multiple']) }}
				</div>
			</div>				
			</fieldset>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Publikasi Kegiatan</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div><label>
					{{ Form::checkbox('calendar_public', 'yes', !empty($data['calendar_public']) && $data['calendar_public'] == "yes"  ? true : false, ['id'=>'publication','class'=>'js-switch']) }} Tersedia untuk Publik
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
	$('#calendar_description').wysiwyg({});
	autosize($('#calendar_description'));
	
	$('#publication').change(function() {
		if ($(this).is(":checked")) {
			$('#share').hide();
		}
		else {
			$('#share').show();
		}
	});
	
	$('#save').click(function() 
	{	
		var hasError = false;
		$('#calendar_description_area').val($('#calendar_description').html());
		
		$('[required]').each(function() {
			if (this.value.trim() == ""){ 
				hasError = true;
				$(this).attr('placeholder', "{{ trans('site.error_required') }}");
				$(this).focus();				
				swal("Error!", "{{ trans('site.error_required') }}", "error");							
			}
		});		
		
		if ($('#calendar_description_area').val() == "") {
			hasError = true;
			$('#calendar_description').focus();				
			swal("Error!", "{{ trans('site.error_required') }}", "error");				
		}		
					
		if (hasError == false){
			$('#form').submit();
		}

		return false;		
	});
});	
</script>
@endsection
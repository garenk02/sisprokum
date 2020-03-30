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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['reminder_id']) ? [$data['reminder_controller'].'.update', $data['reminder_id']] : [$data['reminder_controller'].'.create', null], 'action'=>'reminderController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('reminder_id', null) }}
			{{ Form::hidden('reminder_type', null) }}
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Agenda <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::text('reminder_data_text', !empty($data['reminder_data_text']) ? $data['reminder_data_text'] : "", ['id'=>'reminder_data','class'=>'form-control', 'placeholder'=>'ketik Nomor Agenda Surat Masuk']) }}
				{{ Form::hidden('reminder_data', null, ['id'=>'reminder_data_id']) }} 	
				</div>
			</div>					
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Keterangan</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::bsEditor('reminder_note', !empty($data['reminder_note']) ? $data['reminder_note'] : null) }}
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Batas Tanggal <span style="color:red">*</span></label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::bsDatetime('reminder_date', !empty($data['reminder_date']) ? $data['reminder_date'] : "", ['required'=>true]) }}
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Status Alarm</label>							
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="switch">
						<label>
						{{ Form::checkbox('reminder_status', 'enable', !empty($data['reminder_status']) && $data['reminder_status'] == "enable"  ? true : false, ['class'=>'js-switch']) }} {{ trans('site.active') }}
						</label>
					</div>
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
	$('#reminder_note').wysiwyg({});
	autosize($('#reminder_note'));

	$('#reminder_data').autocomplete({		
		serviceUrl: "{{ url('inbox/list/reminder/'.(!empty($data['reminder_data']) ? $data['reminder_data'] : '')) }}",
		minChars: 3,
		maxHeight: 100,
		onSelect: function (suggestion) {
			$('#reminder_data_id').val(suggestion.receiver_id);
		},		
	});	
	
	$('#save').click(function() 
	{	
		var hasError = false;
		$('#reminder_note_area').val($('#reminder_note').html());
		
		$('[required]').each(function() {
			if (this.value.trim() == ""){ 
				hasError = true;
				$(this).attr('placeholder', "{{ trans('site.error_required') }}");
				$(this).focus();				
				swal("Error!", "{{ trans('site.error_required') }}", "error");							
			}
		});		
		
		if ($('#reminder_note_area').val() == "") {
			hasError = true;
			$('#reminder_note').focus();				
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

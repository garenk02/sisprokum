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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['book_id']) ? ['bookoutbox.update', $data['book_id']] : ['bookoutbox.create', null], 'action'=>'BookOutboxController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('book_id', null, ['id'=>'book_id']) }}		
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Registrasi dan Pengirim</h6>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis Surat <span style="color:red">*</span></label>		
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('book_type', $master_types, null, ['id'=>'book_type','class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>				
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Pengirim <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					{{ Form::text('book_sender', (!empty($data['book_sender_name']) ? $data['book_sender_name'] : "") . (!empty($data['book_sender_post_name']) ? " | ".$data['book_sender_post_name'] : "") . (!empty($data['book_sender_post_code']) ? " | ".$data['book_sender_post_code'] : "") . (!empty($data['book_sender_post_unit']) ? " | ".$data['book_sender_post_unit'] : ""), ['class'=>'form-control sender','required'=>true]) }} 
					{{ Form::hidden('book_sender_id', null, ['id'=>'sender_id','required'=>true]) }}
					{{ Form::hidden('book_sender_post_id', null, ['id'=>'sender_post_id','required'=>true]) }}
					{{ Form::hidden('book_sender_post_type', null, ['id'=>'sender_post_type']) }}
				</div>
			</div>					
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Tujuan Pemesanan</h6>
			</div>		
			<div class="form-group">
				<div class="col-xs-12">
				{{ Form::bsEditor('book_content', !empty($data['book_content']) ? $data['book_content'] : null) }}
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

<div id="popup" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="title" class="modal-title">Popup</h4>
      </div>
      <div id="data" class="modal-body">
        <p>{{ trans('site.error_nodata') }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script language="javascript">
$(document).ready(function() 
{	
	$('.sender').autocomplete({
		serviceUrl: "{{ url('user/list/name') }}",
		onSelect: function (suggestion) {
			$('#sender_id').val(suggestion.data);
			$('#sender_post_id').val(suggestion.post_id);
			$('#sender_post_type').val(suggestion.post_type);
		}		
	});			
		
	$('#book_content').wysiwyg({});
	autosize($('#book_content'));
		
	$('#save').click(function() 
	{	
		var hasError = false;
		$('#book_content_area').val($('#book_content').html());
		
		$('[required]').each(function() {
			if (this.value.trim() == ""){ 
				hasError = true;
				$(this).attr('placeholder', "{{ trans('site.error_required') }}");
				$(this).focus();				
				swal("Error!", "{{ trans('site.error_required') }}", "error");							
			}
		});		
		
		if ($('#book_content_area').val() == "") {
			hasError = true;
			$('#book_content').focus();				
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
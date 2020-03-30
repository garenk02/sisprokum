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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['headoutbox.update', $data['receiver_id']] : ['headoutbox.create', null], 'action'=>'HeadOutboxController@save', 'class'=>'form-horizontal form-label-left', 'files'=>true]) }}
			{{ Form::hidden('outbox_id', null, ['id'=>'outbox_id']) }}
			{{ Form::hidden('receiver_id', null, ['id'=>'receiver_id']) }}
			{{ Form::hidden('outbox_category', 'external') }}
			{{ Form::hidden('outbox_method', null) }}
			{{ Form::hidden('outbox_type', null) }}
			{{ Form::hidden('outbox_agenda', null) }}
			{{ Form::hidden('outbox_agenda_number', null) }}
			{{ Form::hidden('outbox_agenda_class', null) }}
			{{ Form::hidden('outbox_agenda_unit', null) }}
			{{ Form::hidden('outbox_agenda_year', null) }}
			{{ Form::hidden('outbox_date', null) }}
			{{ Form::hidden('outbox_broadcast', null) }}
			{{ Form::hidden('user_status', !empty($data['user_status']) ? $data['user_status'] : 'drafter') }}
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Registrasi dan Jenis Registrasi</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis Surat <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('type', $master_types, !empty($data['outbox_type']) ? $data['outbox_type'] : null, ['id'=>'outbox_type','class'=>'form-control select2_single','disabled'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Sifat<span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('outbox_level', $master_options['urgency'], null, ['id'=>'outbox_level','class'=>'form-control select2_single','disabled'=>true]) }}
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Pengirim</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penandatangan <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::text('outbox_sender', !empty($data['outbox_sender']) ? $data['outbox_sender'] : "", ['class'=>'form-control sender','disabled'=>true]) }}
				{{ Form::hidden('outbox_sender_id', null, ['id'=>'sender_id']) }}
				{{ Form::hidden('outbox_sender_post_id', null, ['id'=>'sender_post_id']) }}
				{{ Form::hidden('outbox_sender_post_code', null, ['id'=>'sender_post_code']) }}
				{{ Form::hidden('outbox_sender_post_type', null, ['id'=>'sender_post_type']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Atas Nama</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::select('outbox_represent', $represent_options, null, ['class'=>'form-control','disabled'=>true]) }}
				{{ Form::hidden('outbox_represent_id', null, ['id'=>'represent_id']) }}
				{{ Form::hidden('outbox_represent_code', null, ['id'=>'represent_code']) }}
				</div>
			</div>				
@if (!empty($data['outbox_corrector']) && $data['outbox_method'] == "attachment")
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Pemeriksa</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Pemeriksa</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
@foreach ($data['outbox_corrector'] as $row => $corrector)
					<div class="border-line">
					{{ Form::text('corrector[]', $corrector['name'] . (!empty($corrector['post']) ? " | ".$corrector['post'] : "") . (!empty($corrector['code']) ? " | ".$corrector['code'] : "") . (!empty($corrector['unit']) ? " | ".$corrector['unit'] : ""), ['class'=>'form-control','disabled'=>true]) }}
					{{ Form::hidden('outbox_corrector[]', $corrector['name'] . (!empty($corrector['post']) ? " | ".$corrector['post'] : "") . (!empty($corrector['code']) ? " | ".$corrector['code'] : "") . (!empty($corrector['unit']) ? " | ".$corrector['unit'] : "")) }}
					{{ Form::hidden('outbox_corrector_ids[]', !empty($corrector['id']) ? $corrector['id'] : 0, ['class'=>'corrector_id']) }}
					{{ Form::hidden('outbox_corrector_posts[]', !empty($corrector['post_id']) ? $corrector['post_id'] : 0, ['class'=>'corrector_post_id']) }}					
					</div>
@endforeach
				</div>
			</div>
@endif			
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Nomor Surat</h6>
			</div>
@if (!empty($data['outbox_agenda']))
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Surat <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<div class="row">
						<div class="col-sm-2 col-xs-12">
						<p>No Urut</p>
						{{ Form::text('outbox_agenda_number', !empty($data['outbox_agenda_number']) ? $data['outbox_agenda_number'] : $agenda_number, ['id'=>'agenda_number','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','disabled'=>true]) }}
						</div>
						<div class="col-sm-4 col-xs-12">
						<p>Klasifikasi</p>
						{{ Form::select('outbox_agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control select2_group','tabindex'=>'-1','disabled'=>true]) }}
						</div>
						<div class="col-sm-4 col-xs-12">
						<p>Kode Unit</p>
						{{ Form::select('outbox_agenda_unit', $post_internal_options, !empty($data['outbox_agenda_unit']) ? $data['outbox_agenda_unit'] : null, ['id'=>'agenda_unit','class'=>'form-control select2_group','tabindex'=>'-1','disabled'=>true]) }}
						</div>
						<div class="col-sm-2 col-xs-12">
						<p>Tahun</p>
						{{ Form::text('outbox_agenda_year', !empty($data['outbox_agenda_year']) ? $data['outbox_agenda_year'] : date('Y'), ['id'=>'agenda_year','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','disabled'=>true]) }}
						</div>
					</div>
				</div>
			</div>
@else
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Klasifikasi <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('outbox_agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control select2_group','tabindex'=>'-1','disabled'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Kode Unit <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('outbox_agenda_unit', $post_internal_options, !empty($data['outbox_agenda_unit']) ? $data['outbox_agenda_unit'] : null, ['id'=>'agenda_unit','class'=>'form-control select2_group','tabindex'=>'-1','disabled'=>true]) }}
				</div>
			</div>
@endif
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Penerima dan Tembusan</h6>
			</div>
			<fieldset id="broadcast">
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">&nbsp;</label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::checkbox('outbox_broadcast', 'yes', null, ['class'=>'flat','disabled'=>true]) }}
				{{ Form::label('outbox_broadcast', 'Kirim ke seluruh Staf') }}
				</div>
			</div>
			</fieldset>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penerima</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="receiver">
@if (!empty($data['outbox_receiver']))
	@foreach ($data['outbox_receiver'] as $row => $receiver)
					<div class="row border-line input-form">
						<div class="col-xs-12">
							<label for="name">Nama</label>
							{{ Form::text('receiver[name][]', $receiver['name'], ['class'=>'form-control','disabled'=>true]) }}
							<label for="post_name">Jabatan</label>
							{{ Form::text('receiver[post][]', $receiver['post'], ['class'=>'form-control','disabled'=>true]) }}
							<label for="post_unit">Nama Unit</label>
							{{ Form::text('receiver[unit][]', $receiver['unit'], ['class'=>'form-control','disabled'=>true]) }}
						</div>
					</div>
	@endforeach
@endif
					</fieldset>
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tembusan</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="cc">
@if (!empty($data['outbox_cc']))
	@foreach ($data['outbox_cc'] as $row => $cc)
					<div class="row border-line input-form">
						<div class="col-xs-12">
							<label for="name">Nama</label>
							{{ Form::text('cc[name][]', $cc['name'], ['class'=>'form-control','disabled'=>true]) }}
							<label for="post_name">Jabatan</label>
							{{ Form::text('cc[post][]', $cc['post'], ['class'=>'form-control','disabled'=>true]) }}
							<label for="post_unit">Nama Unit</label>
							{{ Form::text('cc[unit][]', $cc['unit'], ['class'=>'form-control','disabled'=>true]) }}
						</div>
					</div>
	@endforeach
@endif
					</fieldset>
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Hal</h6>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="well">
						{!! !empty($data['outbox_content']) ? $data['outbox_content'] : "" !!}
					</div>
				</div>
			</div>
@if (in_array($profile['user_level'], [1,4]))
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Metadata</h6>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tanggal Retensi</label>
						<div class="col-sm-8 col-xs-12">{{ Form::bsDaterange('outbox_meta_retention', !empty($data['outbox_meta_active_date']) ? $data['outbox_meta_active_date'] : "", !empty($data['outbox_meta_inactive_date']) ? $data['outbox_meta_inactive_date'] : "") }}</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Dasar Hukum Retensi</label>
						<div class="col-sm-8 col-xs-12">
							{{ Form::textarea('outbox_meta_reference', null, ['class'=>'form-control','rows'=>3,'disabled'=>true]) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tingkat Perkembangan</label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::select('outbox_meta_type', $master_options['type'], !empty($data['outbox_meta_type']) ? $data['outbox_meta_type'] : "Asli", ['class'=>'form-control select2_single']) }}
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">File dan Arsip</h6>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Media Arsip</label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::select('outbox_file_media', $master_options['media'], !empty($data['outbox_file_media']) ? $data['outbox_file_media'] : 'Kertas', ['class'=>'form-control select2_single']) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Bahasa</label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::select('outbox_file_language', $master_options['language'], !empty($data['outbox_file_language']) ? $data['outbox_file_language'] : 'Bahasa Indonesia', ['class'=>'form-control select2_single','disabled'=>true]) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Lampiran</label>
						<div class="col-sm-8 col-xs-12">
							<div class="row">
								<div class="col-xs-6">
								{{ Form::number('outbox_file_number', null, ['class'=>'form-control','disabled'=>true]) }}
								</div>
								<div class="col-xs-6">
								{{ Form::select('outbox_file_unit', $master_options['unit'], !empty($data['outbox_file_unit']) ? $data['outbox_file_unit'] : 'Lembar', ['class'=>'form-control select2_single','disabled'=>true]) }}
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Keterangan</label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::text('outbox_file_note', null, ['class'=>'form-control','disabled'=>true]) }}
						</div>
					</div>
				</div>
			</div>
@endif
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">File Surat</h6>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-3 col-xs-12">Unggah File</label>
						<div class="col-md-10 col-sm-9 col-xs-12">
						<small>
						<ul class="well">
						<li>Kosongkan/abaikan jika tidak ingin mengubah.</li>
						<li>Tipe file yang di izinkan: doc, docx, pdf.</li>
						</ul>
						</small>
@if (!empty($data['outbox_meta_files']))
@foreach ($data['outbox_meta_files'] as $file)
						<div class="input-group">
						{{ Form::text('outbox_meta_files[]', $file, ['class'=>'form-control receiver', 'onclick'=>'blur()', 'onfocus'=>'blur()']) }}
						<span class="input-group-btn">
						<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-info view" rel="{{ $file }}"><i class="fa fa-eye"></i></button>
						<button type="button" class="btn btn-success download" rel="{{ $file }}"><i class="fa fa-download"></i></button>
						</span>
						</div>
@endforeach
@endif
						{{ Form::file('file_1', empty($data['outbox_meta_files']) ? ['class' => 'form-control','required'=>true] : ['class' => 'form-control']) }}
						{{ Form::file('file_2', ['class' => 'form-control']) }}
						</div>
					</div>
				</div>
			</div>
@if (in_array($profile['user_level'], [3]) || (in_array($profile['user_level'], [6]) && !empty($data['outbox_status']) && ($data['outbox_status'] == "corrector" || $data['outbox_status'] == "user")))
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Pemeriksa</h6>
			</div>
			<fieldset id="action">
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tindakan</label>
				<div class="col-sm-6 col-xs-12">
					<div class="col-xs-6">
					{{ Form::radio('action', 'return', false, ['class'=>'flat action']) }} Kembalikan
					</div>
					<div class="col-xs-6">
					{{ Form::radio('action', 'continue', false, ['class'=>'flat action']) }} Teruskan
					</div>
				</div>
			</div>
			</fieldset>
			<fieldset id="return" style="display:none">
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Komentar</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::bsEditor('note', "") }}
				</div>
			</div>
			</fieldset>
			<fieldset id="continue" style="display:none">
@if (in_array($profile['user_level'], [3]))
			{{ Form::hidden('outbox_agenda_number', null) }}
			{{ Form::hidden('outbox_agenda_class', null) }}
			{{ Form::hidden('outbox_agenda_unit', null) }}
			{{ Form::hidden('outbox_agenda_year', null) }}
@endif
			</fieldset>
@endif
@if (in_array($profile['user_level'], [1]))
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Administrator</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Metode Proses</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::select('outbox_method', $method_options, null, ['class'=>'form-control select2_single']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Status Posisi</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::select('outbox_status', $status_options, null, ['class'=>'form-control select2_single']) }}
				</div>
			</div>
@endif
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
/*
	$('#outbox_type').change(function() {
		if ($(this).val() == "Edaran" || $(this).val() == "Pengumuman") {
			$('#broadcast').show();
		}
		else {
			$('#broadcast').iCheck('uncheck');
			$('#broadcast').hide();
		}
	});
*/
	$('.view').click(function(){
		$('#title').html('Berkas Copy Digital');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('reportoutbox/fileview') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});

	$('.download').click(function(){
		var	url = "{{ url('reportoutbox/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});

	$('#note').wysiwyg({});
	autosize($('#note'));

	$('.action').on('ifChecked', function(event) {
		var action = $(this).val();
		if (action == "return") {
			$('#return').show();
			$('#return :input').attr("disabled", false);
			$('#continue').hide();
			$('#continue :input').attr("disabled", true);
		}
		else if (action == "continue") {
			$('#return').hide();
			$('#return :input').attr("disabled", true);
			$('#continue').show();
			$('#continue :input').attr("disabled", false);
		}
		else {
			$('#return').hide();
			$('#return :input').attr("disabled", true);
			$('#continue').hide();
			$('#continue :input').attr("disabled", true);
		}
	});

	$('#save').click(function()
	{
		var hasError = false;
		$('#note_area').val($('#note').html());

		$('[required]').each(function() {
			if (this.value.trim() == ""){
				hasError = true;
				$(this).attr('placeholder', "{{ trans('site.error_required') }}");
				$(this).focus();
				swal("Error!", "{{ trans('site.error_required') }}", "error");
			}
		});

		if ($('.action').val()) {
			if ($('[name="action"]:checked').length <= 0) {
				hasError = true;
				$(this).focus();
				swal("Error!", "{{ trans('site.error_required') }}", "error");
			}
		}

		if (hasError == false){
			$('#form').submit();
		}

		return false;
	});
});
</script>
@endsection

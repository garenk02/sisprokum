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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['outnote.update', $data['receiver_id']] : ['outnote.create', null], 'action'=>'NoteController@save', 'class'=>'form-horizontal form-label-left', 'files'=>true]) }}
			{{ Form::hidden('memo_id', null, ['id'=>'memo_id']) }}
			{{ Form::hidden('memo_category', 'internal') }}
			{{ Form::hidden('memo_type', 'Nota Dinas') }}
			{{ Form::hidden('user_status', !empty($data['user_status']) ? $data['user_status'] : 'drafter') }}
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Registrasi dan Jenis Registrasi</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Sifat <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('memo_level', $master_options['urgency'], null, ['class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Lampiran</label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::text('memo_file_note', null, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Pengirim</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penandatangan <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					{{ Form::text('memo_sender', !empty($data['memo_sender']) ? $data['memo_sender'] : "", ['class'=>'form-control sender','required'=>true]) }}
					{{ Form::hidden('memo_sender_id', null, ['id'=>'sender_id','required'=>true]) }}
					{{ Form::hidden('memo_sender_post_id', null, ['id'=>'sender_post_id']) }}
					{{ Form::hidden('memo_sender_post_code', null, ['id'=>'sender_post_code']) }}
					{{ Form::hidden('memo_sender_post_type', null, ['id'=>'sender_post_type']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Atas Nama</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::select('memo_represent', $represent_options, !empty($data['memo_represent']) ? $data['memo_represent'] : "", ['id'=>'represent','class'=>'form-control select2_single']) }}
				{{ Form::hidden('memo_represent_id', null, ['id'=>'represent_id']) }}
				{{ Form::hidden('memo_represent_code', null, ['id'=>'represent_code']) }}
				</div>
			</div>			
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Pemeriksa</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Pemeriksa <button type="button" id="add_corrector" class="btn btn-xs btn-info">+</button></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="corrector">
@if (!empty($data['memo_corrector']))
	@foreach ($data['memo_corrector'] as $row => $corrector)
					<div class="input-group input-form">
					{{ Form::text('memo_corrector[]', $corrector['name'] . (!empty($corrector['post']) ? " | ".$corrector['post'] : "") . (!empty($corrector['code']) ? " | ".$corrector['code'] : "") . (!empty($corrector['unit']) ? " | ".$corrector['unit'] : ""), ['class'=>'form-control corrector']) }} 
					{{ Form::hidden('memo_corrector_ids[]', !empty($corrector['id']) ? $corrector['id'] : 0, ['class'=>'corrector_id']) }}
					{{ Form::hidden('memo_corrector_posts[]', !empty($corrector['post_id']) ? $corrector['post_id'] : 0, ['class'=>'corrector_post_id']) }}
					<span class="input-group-btn">
					<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
					</span>
					</div>
	@endforeach
@else
					<div class="input-group input-form">
					{{ Form::text('memo_corrector[]', "", ['id'=>'correctors','class'=>'form-control corrector']) }} 
					{{ Form::hidden('memo_corrector_ids[]', "", ['class'=>'corrector_id']) }}
					{{ Form::hidden('memo_corrector_posts[]', "", ['class'=>'corrector_post_id']) }}
					<span class="input-group-btn">
					<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
					</span>
			 		</div>
@endif
					</fieldset>
					<fieldset id="corrector_tmp" style="display: none">
					<div class="input-group input-form">
					{{ Form::text('memo_corrector[]', "", ['class'=>'form-control corrector']) }}
					{{ Form::hidden('memo_corrector_ids[]', "", ['class'=>'corrector_id']) }}
					{{ Form::hidden('memo_corrector_posts[]', "", ['class'=>'corrector_post_id']) }}
					<span class="input-group-btn">
					<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
					</span>
					</div>
					</fieldset>
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Nomor Surat</h6>
			</div>
@if (!empty($data['memo_agenda_number']))
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Surat <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<div class="row">
						<div class="col-sm-2 col-xs-12">
						<p>No Urut</p>
						{{ Form::text('memo_agenda_number', !empty($data['memo_agenda_number']) ? $data['memo_agenda_number'] : $agenda_number, ['id'=>'agenda_number','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','required'=>true]) }}
						</div>
						<div class="col-sm-4 col-xs-12">
						<p>Klasifikasi</p>
						{{ Form::select('memo_agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control select2_group','tabindex'=>'-1']) }}
						</div>
						<div class="col-sm-4 col-xs-12">
						<p>Kode Unit</p>
						{{ Form::select('memo_agenda_unit', $post_internal_options, !empty($data['memo_agenda_unit']) ? $data['memo_agenda_unit'] : null, ['id'=>'agenda_unit','class'=>'form-control select2_group','tabindex'=>'-1']) }}
						</div>
						<div class="col-sm-2 col-xs-12">
						<p>Tahun</p>
						{{ Form::text('memo_agenda_year', !empty($data['memo_agenda_year']) ? $data['memo_agenda_year'] : date('Y'), ['id'=>'agenda_year','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','required'=>true]) }}
						</div>
					</div>
				</div>
			</div>
@else
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Klasifikasi <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('memo_agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control select2_group','tabindex'=>'-1']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Kode Unit <span style="color:red">*</span></label>
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('memo_agenda_unit', $post_internal_options, null, ['id'=>'agenda_unit','class'=>'form-control select2_group','tabindex'=>'-1']) }}
				{{ Form::hidden('memo_agenda_year', !empty($data['memo_agenda_year']) ? $data['memo_agenda_year'] : date('Y')) }}
				</div>
			</div>
@endif
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Penerima dan Tembusan</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penerima <button type="button" id="add_receiver" class="btn btn-xs btn-info">+</button></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="receiver">
@if (!empty($data['memo_receiver']))
	@foreach ($data['memo_receiver'] as $row => $receiver)
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<label for="name">Nama</label>		
							{{ Form::hidden('receiver[id][]', !empty($receiver['id']) ? $receiver['id'] : "", ['class'=>'receiver_id']) }}
							{{ Form::text('receiver[name][]', $receiver['name'], ['class'=>'form-control receiver_name receiver']) }}					
							<label for="post_name">Jabatan</label>	
							{{ Form::hidden('receiver[post_id][]', !empty($receiver['post_id']) ? $receiver['post_id'] : "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('receiver[post_type][]', !empty($receiver['post_type']) ? $receiver['post_type'] : "", ['class'=>'receiver_post_type']) }}								
							{{ Form::text('receiver[post][]', $receiver['post'], ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('receiver[unit][]', $receiver['unit'], ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
						</div>
					</div>
	@endforeach
@else					
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<label for="name">Nama</label>		
							{{ Form::hidden('receiver[id][]', "", ['class'=>'receiver_id']) }}							
							{{ Form::text('receiver[name][]', "", ['class'=>'form-control receiver_name receiver']) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('receiver[post_id][]', "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('receiver[post_type][]', "", ['class'=>'receiver_post_type']) }}								
							{{ Form::text('receiver[post][]', "", ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('receiver[unit][]', "", ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
						</div>
					</div>
@endif
					</fieldset>
					<fieldset id="receiver_tmp" style="display: none">
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<label for="name">Nama</label>	
							{{ Form::hidden('receiver[id][]', "", ['class'=>'receiver_id']) }}		
							{{ Form::text('receiver[name][]', "", ['class'=>'form-control receiver_name receiver']) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('receiver[post_id][]', "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('receiver[post_type][]', "", ['class'=>'receiver_post_type']) }}								
							{{ Form::text('receiver[post][]', "", ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('receiver[unit][]', "", ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
						</div>				
					</div>
					</fieldset>
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tembusan <button type="button" id="add_cc" class="btn btn-xs btn-info">+</button></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="cc">
@if (!empty($data['memo_cc']))
	@foreach ($data['memo_cc'] as $row => $cc)
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<label for="name">Nama</label>		
							{{ Form::hidden('cc[id][]', !empty($cc['id']) ? $cc['id'] : "", ['class'=>'receiver_id']) }}
							{{ Form::text('cc[name][]', $cc['name'], ['class'=>'form-control receiver_name receiver']) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('cc[post_id][]', !empty($cc['post_id']) ? $cc['post_id'] : "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('cc[post_type][]', !empty($cc['post_type']) ? $cc['post_type'] : "", ['class'=>'receiver_post_type']) }}														
							{{ Form::text('cc[post][]', $cc['post'], ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('cc[unit][]', $cc['unit'], ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
						</div>						
					</div>
	@endforeach
@else					
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<label for="name">Nama</label>		
							{{ Form::hidden('cc[id][]', "", ['class'=>'receiver_id']) }}
							{{ Form::text('cc[name][]', "", ['class'=>'form-control receiver_name receiver']) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('cc[post_id][]', "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('cc[post_type][]', "", ['class'=>'receiver_post_type']) }}							
							{{ Form::text('cc[post][]', "", ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('cc[unit][]', "", ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
						</div>
					</div>
@endif
					</fieldset>				
					<fieldset id="cc_tmp" style="display: none">
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<label for="name">Nama</label>		
							{{ Form::hidden('cc[id][]', "", ['class'=>'receiver_id']) }}
							{{ Form::text('cc[name][]', "", ['class'=>'form-control receiver_name receiver']) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('cc[post_id][]', "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('cc[post_type][]', "", ['class'=>'receiver_post_type']) }}
							{{ Form::text('cc[post][]', "", ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('cc[unit][]', "", ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
						</div>						
					</div>
					</fieldset>	
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Hal</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Hal <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					{{ Form::text('memo_title', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
				{{ Form::textarea('memo_content', null, ['id'=>'ckeditor']) }}
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Lampiran</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">&nbsp;</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				<small>
				<ul class="well">
				<li>Kosongkan/abaikan jika tidak ada lampiran.</li>
				<li>Ukuran file yang diizinkan maksimal: 25MB.</li>
				<li>Tipe file yang di izinkan: jpg, png, pdf.</li>
				</ul>
				</small>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">&nbsp;</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
@if (!empty($data['memo_relation']))
					<ul class="list-unstyled">
	@foreach ($data['memo_relation'] as $relation)
					<li><p>- {{ $relation['relation_agenda'] }}
					<span class="pull-right">
					<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-xs btn-success peek-{{ $relation['relation_type'] }}" rel="{{ $relation['relation_agenda'] }}" title="Lihat Relasi"><i class="fa fa-eye"></i></button>
		@if (in_array($relation['relation_user'], $profile['user_posts']))
					<button type="button" class="btn btn-xs btn-danger remove" rel="{{ $relation['relation_id'] }}" title="Hapus Relasi" onclick="return confirm('{{ trans('site.confirm_delete') }}')"><i class="fa fa-trash"></i></button>
		@endif
					</span></p>
					</li>
	@endforeach
					</ul>
@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Surat Masuk</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::text('inbox_relation_text', !empty($inbox['text']) ? $inbox['text'] : "", ['id'=>'inbox_relation','class'=>'form-control', 'placeholder'=>'ketik Nomor Agenda Surat Masuk']) }}
				{{ Form::hidden('inbox_relation[]', !empty($inbox['id']) ? $inbox['id'] : "", ['id'=>'inbox_relation_id']) }} 	
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Surat Keluar</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::text('outbox_relation_text', "", ['id'=>'outbox_relation','class'=>'form-control', 'placeholder'=>'ketik Nomor Agenda Surat Keluar']) }}
				{{ Form::hidden('outbox_relation[]', "", ['id'=>'outbox_relation_id']) }} 	
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Copy Digital</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
@if (!empty($data['memo_meta_files']))
	@foreach ($data['memo_meta_files'] as $file)
				<div class="input-group input-form">
				{{ Form::text('memo_meta_files[]', $file, ['class'=>'form-control receiver', 'onclick'=>'blur()', 'onfocus'=>'blur()']) }}
				<span class="input-group-btn">
				<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-info view" rel="{{ $file }}"><i class="fa fa-eye"></i></button>
				<button type="button" class="btn btn-success download" rel="{{ $file }}"><i class="fa fa-download"></i></button>
				<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>				
				</span>
				</div>
	@endforeach
@endif
				{{ Form::file('file_1', ['class' => 'form-control']) }}
				{{ Form::file('file_2', ['class' => 'form-control']) }}
				</div>
			</div>			
@if (!empty($data['memo_status']) && ($data['memo_status'] == "corrector" || $data['memo_status'] == "user"))
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Tindak Lanjut</h6>
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
			{{ Form::hidden('memo_corrector_prev', !empty($data['memo_corrector_prev']) ? $data['memo_corrector_prev'] : 0) }}
			{{ Form::hidden('memo_corrector_next', !empty($data['memo_corrector_next']) ? $data['memo_corrector_next'] : 0) }}
			<fieldset id="return" style="display:none">
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Komentar</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::bsEditor('note', "") }}
				</div>
			</div>
			</fieldset>
			<fieldset id="continue" style="display:none">
@if ($data['memo_status'] == "user")
			{{ Form::hidden('memo_agenda_number', !empty($data['memo_agenda_number']) ? $data['memo_agenda_number'] : $agenda_number, ['id'=>'agenda_number','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','disabled'=>true]) }}
			{{ Form::hidden('memo_agenda_class', null) }}
			{{ Form::hidden('memo_agenda_unit', null) }}
			{{ Form::hidden('memo_agenda_year', null) }}
@endif
			</fieldset>
@endif
@if (in_array($profile['user_level'], [1]))
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Administrator</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Status Posisi</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::select('memo_status', $status_options, null, ['class'=>'form-control select2_single']) }}
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
<!-- Ckeditor -->
<script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>

<script language="javascript">
$(document).ready(function()
{
	$('#add_receiver').click(function() {
		var $template = $('#receiver_tmp').html();
		$('#receiver').append($template);

		$('.remove').click(function() {
			remove(this);
		});

		$('.receiver').autocomplete({
			serviceUrl: "{{ url('user/list/name') }}",
			onSelect: function (suggestion) {
				var input = $(this).closest('div');
				
				input.find('.receiver_id').val(suggestion.data);
				input.find('.receiver_post_id').val(suggestion.post_id);
				input.find('.receiver_post_type').val(suggestion.post_type);			
				input.find('.receiver_post').val(suggestion.post_name);
				input.find('.receiver_unit').val(suggestion.post_unit);	
			}
		});
	});

	$('#add_cc').click(function() {
		var $template = $('#cc_tmp').html();
		$('#cc').append($template);

		$('.remove').click(function() {
			remove(this);
		});

		$('.receiver').autocomplete({
			serviceUrl: "{{ url('user/list/name') }}",
			onSelect: function (suggestion) {
				var input = $(this).closest('div');
				
				input.find('.receiver_id').val(suggestion.data);
				input.find('.receiver_post_id').val(suggestion.post_id);
				input.find('.receiver_post_type').val(suggestion.post_type);			
				input.find('.receiver_post').val(suggestion.post_name);
				input.find('.receiver_unit').val(suggestion.post_unit);	
			}
		});
	});

	$('#add_corrector').click(function() {
		var $template = $('#corrector_tmp').html();
		$('#corrector').append($template);

		$('.remove').click(function() {
			remove(this);
		});

		$('.corrector').autocomplete({
			serviceUrl: "{{ url('user/list/name') }}",
			onSelect: function (suggestion) {
				var input = $(this).closest('.input-group');
				
				input.find('.corrector_id').val(suggestion.data);
				input.find('.corrector_post_id').val(suggestion.post_id);
			}		
		});
	});

	$('#inbox_relation').autocomplete({		
		serviceUrl: "{{ url('inbox/list/memo') }}",
		minChars: 3,
		maxHeight: 100,
		onSelect: function (suggestion) {
			$('#inbox_relation_id').val(suggestion.data);
		},		
	});

	$('#outbox_relation').autocomplete({		
		serviceUrl: "{{ url('outbox/list/memo') }}",
		minChars: 3,
		maxHeight: 100,
		onSelect: function (suggestion) {
			$('#outbox_relation_id').val(suggestion.data);
		},		
	});	

	$('.peek-inbox').click(function(){
		$('#title').html('Relasi Surat Masuk');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['relation_id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('inbox/relationfile') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});

	$('.peek-outbox').click(function(){
		$('#title').html('Relasi Surat Keluar');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['relation_id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('outbox/relationfile') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});	
	
	$('.view').click(function(){
		$('#title').html('Berkas Copy Digital');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('outnote/fileview') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});

	$('.download').click(function(){
		var	url = "{{ url('outnote/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});

	$('.remove').click(function() {
		remove(this);
	});

	function remove(id) {
		$(id).closest('div.input-form').remove();
	}
		
	$('.sender').autocomplete({
		serviceUrl: "{{ url('user/list/name') }}",
		onSelect: function (suggestion) {
			$('#sender_id').val(suggestion.data);
			$('#sender_post_id').val(suggestion.post_id);
			$('#sender_post_code').val(suggestion.post_code);
			$('#sender_post_type').val(suggestion.post_type);
			if ($('#represent_code').val() != ""){
				$('#agenda_unit').val($('#represent_code').val()).change();				
			}
			else {
				$('#agenda_unit').val(suggestion.post_code).change();
			}		
		}
	});

	$('#represent').change(function() {
		if ($('#represent').val() != "") {
			var array = $('#represent').val().split('-');
			$('#represent_id').val(array[0]);
			$('#represent_code').val(array[1]);
			$('#agenda_unit_id').val($('#represent_code').val());
			$('#agenda_unit').val($('#represent_code').val()).change();				
		}
		else {
			$('#represent_id').val('');
			$('#represent_code').val('');
			$('#agenda_unit_id').val($('#sender_post_code').val());
			$('#agenda_unit').val($('#sender_post_code').val()).change();			
		}
	});	
	
	$('.receiver').autocomplete({
		serviceUrl: "{{ url('user/list/name') }}",
		onSelect: function (suggestion) {
			var input = $(this).closest('div');
			
			input.find('.receiver_id').val(suggestion.data);
			input.find('.receiver_post_id').val(suggestion.post_id);
			input.find('.receiver_post_type').val(suggestion.post_type);			
			input.find('.receiver_post').val(suggestion.post_name);
			input.find('.receiver_unit').val(suggestion.post_unit);				
			input.val(suggestion.data);
		}
	});

	$('.corrector').autocomplete({
		serviceUrl: "{{ url('user/list/name') }}",
		onSelect: function (suggestion) {
			var input = $(this).closest('.input-group');
			
			input.find('.corrector_id').val(suggestion.data);
			input.find('.corrector_post_id').val(suggestion.post_id);
		}		
	});

	$('#note').wysiwyg({});
	autosize($('#note'));
	
	$('#note').on('click', function () {
		 CKEDITOR.instances.note.destroy();
	});

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

		if ($('#memo_content_area').val() == "") {
			hasError = true;
			$('#memo_content').focus();
			swal("Error!", "{{ trans('site.error_required') }}", "error");
		}

		if (hasError == false){
			$('#form').submit();
		}

		return false;
	});

    CKEDITOR.replace('ckeditor', {
		toolbarGroups: [
			{ name: 'document', groups: [ 'document', 'doctools' ] },
			{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
			{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
			{ name: 'forms', groups: [ 'forms' ] },
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
			{ name: 'colors', groups: [ 'colors' ] },
			{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
			{ name: 'links', groups: [ 'links' ] },
			{ name: 'insert', groups: [ 'insert' ] },
			'/',
			{ name: 'styles', groups: [ 'styles' ] },
			{ name: 'tools', groups: [ 'tools' ] },
			{ name: 'others', groups: [ 'others' ] },
			{ name: 'about', groups: [ 'about' ] }
		],
		removeButtons: 'Save,NewPage,Preview,Print,Templates,Scayt,SelectAll,Find,Replace,BGColor,Blockquote,HorizontalRule,ShowBlocks,BidiRtl,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,Anchor,Link,Unlink,Flash,Smiley,Iframe,Image,About,CreateDiv,Language,CopyFormatting'
	});
    CKEDITOR.config.height = 300;
});
</script>
@endsection

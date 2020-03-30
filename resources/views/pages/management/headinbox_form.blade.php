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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['headinbox.update', $data['receiver_id']] : ['headinbox.create', null], 'action'=>'HeadInboxController@save', 'class'=>'form-horizontal form-label-left', 'files'=>true]) }}
			{{ Form::hidden('inbox_id', null, ['id'=>'inbox_id']) }}
@if (!empty($data['inbox_secretary_note']))
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Catatan Pengembalian Sekretaris</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Sekretaris</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<div class="input-group">{{ $data['inbox_secretary_name'] }} <span class="pull-right"><small>{{ $data['inbox_secretary_date_text'] }}</small></span></div>
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Catatan</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<div class="input-group">{!! $data['inbox_secretary_note'] !!}</div>
				</div>
			</div>	
@endif
			<div class="row">	
				<div class="col-sm-6 col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Registrasi dan Jenis Registrasi</h6>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Kategori Surat <span style="color:red">*</span></label>
						<div class="col-sm-8 col-xs-12">
							<div class="col-xs-6">
							{{ Form::radio('inbox_category', 'internal', !empty($data['inbox_category']) && $data['inbox_category'] <> 'internal' ? false : true, ['class'=>'flat category']) }} Internal
							</div>
							<div class="col-xs-6">
							{{ Form::radio('inbox_category', 'external', !empty($data['inbox_category']) && $data['inbox_category'] <> 'internal' ? true : false, ['class'=>'flat category']) }} Eksternal
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Jenis Surat <span style="color:red">*</span></label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::select('inbox_type', $master_types, (!empty($data['inbox_type']) ? $data['inbox_type'] : "Surat Dinas"), ['id'=>'inbox_type','class'=>'form-control select2_single','required'=>true]) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tanggal Surat <span style="color:red">*</span></label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::bsDate('inbox_date', !empty($data['inbox_date']) ? $data['inbox_date'] : "", ['required'=>true]) }}
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Pengirim</h6>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Nama <span style="color:red">*</span></label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::hidden('inbox_sender_id', null, ['id'=>'sender_id']) }}
						{{ Form::text('inbox_sender_name', null, ['id'=>'sender_name','class'=>'form-control','required'=>true]) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Jabatan <span style="color:red">*</span></label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::hidden('inbox_sender_post_id', null, ['id'=>'sender_post_id']) }}
						{{ Form::hidden('inbox_sender_post_code', null, ['id'=>'sender_post_code']) }}
						{{ Form::hidden('inbox_sender_post_type', null, ['id'=>'sender_post_type']) }}
						<fieldset id="senderInternal" style="{{ !empty($data['inbox_category']) && $data['inbox_category'] <> 'internal' ? 'display:none' : '' }}">
						{{ Form::text('inbox_sender_post_name', null, ['id'=>'sender_post_name','class'=>'form-control']) }}
						</fieldset>
						<fieldset id="senderExternal" style="{{ !empty($data['inbox_category']) && $data['inbox_category'] <> 'internal' ? '' : 'display:none' }}">
						{{ Form::text('inbox_sender_post_name', null, ['id'=>'sender_post_ex','class'=>'form-control','disabled'=>true]) }}
						</fieldset>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Nama Unit <span style="color:red">*</span></label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::text('inbox_sender_post_unit', null, ['id'=>'sender_post_unit','class'=>'form-control','required'=>true]) }}
						</div>
					</div>
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Nomor Surat dan Agenda</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Surat</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<div class="input-group">
					{{ Form::text('inbox_number', null, ['id'=>'inbox_number','class'=>'form-control']) }}
					<span class="input-group-btn">
					<button type="button" id="autonumber" class="btn btn-success"><i class="fa fa-magic"></i></button>
					</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Agenda <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<div class="row">
						<div class="col-sm-2 col-xs-12">
						<p>No Urut</p>
						{{ Form::text('inbox_agenda_number', !empty($data['inbox_agenda_number']) ? $data['inbox_agenda_number'] : $agenda_number, ['id'=>'agenda_number','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','required'=>true]) }}
						</div>
						<div class="col-sm-4 col-xs-12">
						<p>Klasifikasi</p>
						{{ Form::select('inbox_agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control select2_group','tabindex'=>'-1']) }}
						</div>
						<div class="col-sm-4 col-xs-12">
						<p>Kode Unit</p>
						<fieldset id="postExternal" style="{{ !empty($data['inbox_category']) && $data['inbox_category'] <> 'internal' ? 'display:none' : '' }}">
						{{ Form::select('inbox_agenda_unit_in', !empty($data['inbox_outbox']) ? $post_internal_options : $post_external_options, !empty($data['inbox_agenda_unit']) ? $data['inbox_agenda_unit'] : null, ['id'=>'agenda_unit', 'class'=>'form-control select2_group','tabindex'=>'-1']) }}
						</fieldset>
						<fieldset id="postInstitute" style="{{ !empty($data['inbox_category']) && $data['inbox_category'] <> 'internal' ? '' : 'display:none' }}">
						{{ Form::select('inbox_agenda_unit_ex', $institute_options, !empty($data['inbox_agenda_unit']) ? $data['inbox_agenda_unit'] : null, ['id'=>'agenda_unit_ex','class'=>'form-control select2_group','tabindex'=>'-1']) }}
						</fieldset>
						</div>
						<div class="col-sm-2 col-xs-12">
						<p>Tahun</p>
						{{ Form::text('inbox_agenda_year', !empty($data['inbox_agenda_year']) ? $data['inbox_agenda_year'] : date('Y'), ['id'=>'agenda_year','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','required'=>true]) }}
						</div>
					</div>
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Penerima dan Tembusan</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penerima
					<button type="button" id="add_receiver" class="btn btn-xs btn-info">+</button>
				</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="receiver">
@if (!empty($data['inbox_receiver']))
	@foreach ($data['inbox_receiver'] as $row => $receiver)
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<p>{{ Form::select('receiver[type][]', $type_options, !empty($receiver['type']) ? $receiver['type'] : null, ['class'=>'form-control type']) }}</p>
							<label for="name">Nama</label>
							{{ Form::hidden('receiver[id][]', !empty($receiver['id']) ? $receiver['id'] : "", ['class'=>'receiver_id']) }}
							{{ Form::text('receiver[name][]', $receiver['name'], (empty($receiver['type']) || $receiver['type'] == "internal" ? ['class'=>'form-control receiver_name receiver'] : ['class'=>'form-control receiver_name'])) }}
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
							<p>{{ Form::select('receiver[type][]', $type_options, "", ['class'=>'form-control type']) }}</p>
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
							<p>{{ Form::select('receiver[type][]', $type_options, "", ['class'=>'form-control type']) }}</p>
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
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tembusan
					<button type="button" id="add_cc" class="btn btn-xs btn-info">+</button>
				</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="cc">
@if (!empty($data['inbox_cc']))
	@foreach ($data['inbox_cc'] as $row => $cc)
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<p>{{ Form::select('cc[type][]', $type_options, !empty($cc['type']) ? $cc['type'] : null, ['class'=>'form-control type']) }}</p>
							<label for="name">Nama</label>
							{{ Form::hidden('cc[id][]', !empty($cc['id']) ? $cc['id'] : "", ['class'=>'receiver_id']) }}
							{{ Form::text('cc[name][]', $cc['name'], (empty($cc['type']) || $cc['type'] == "internal" ? ['class'=>'form-control receiver_name receiver'] : ['class'=>'form-control receiver_name'])) }}
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
							<p>{{ Form::select('cc[type][]', $type_options, "", ['class'=>'form-control type']) }}</p>
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
							<p>{{ Form::select('cc[type][]', $type_options, "", ['class'=>'form-control type']) }}</p>
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
				<div class="col-xs-12">
				{{ Form::bsEditor('inbox_content', !empty($data['inbox_content']) ? $data['inbox_content'] : null) }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Metadata</h6>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tanggal Retensi</label>
						<div class="col-sm-8 col-xs-12">{{ Form::bsDaterange('inbox_meta_retention', !empty($data['inbox_meta_active_date']) ? $data['inbox_meta_active_date'] : "", !empty($data['inbox_meta_inactive_date']) ? $data['inbox_meta_inactive_date'] : "") }}</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Dasar Hukum Retensi</label>
						<div class="col-sm-8 col-xs-12">
							{{ Form::textarea('inbox_meta_reference', null, ['class'=>'form-control','rows'=>3]) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tingkat Perkembangan</label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::select('inbox_meta_type', $master_options['type'], null, ['class'=>'form-control select2_single']) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Copy Digital</label>
						<div class="col-sm-8 col-xs-12">
						<small>
						<ul class="well">
						<li>Kosongkan/abaikan jika tidak ingin mengubah.</li>
						<li>Ukuran file yang diizinkan maksimal: 100MB.</li>
						<li>Tipe file yang di izinkan: jpg, png, pdf.</li>
						</ul>
						</small>
@if (!empty($data['inbox_meta_files']))
@foreach ($data['inbox_meta_files'] as $file)
						<div class="input-group input-form">
						{{ Form::text('inbox_meta_files[]', $file, ['class'=>'form-control', 'onclick'=>'blur()', 'onfocus'=>'blur()']) }}
						<span class="input-group-btn">
@if ($source == "app")
						<a href="{{ preg_match('/http/i', $file) ? $file : asset('uploads/'.$file) }}" class="btn btn-xs btn-success" title="Lihat Berkas"><i class="fa fa-eye"></i></a> 
@else
						
						<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-info view" rel="{{ $file }}"><i class="fa fa-eye"></i></button>
						<button type="button" class="btn btn-success download" rel="{{ $file }}"><i class="fa fa-download"></i></button>
@endif
						<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
						</span>
						</div>
@endforeach
@endif
						{{ Form::file('file_1', ['class' => 'form-control']) }}
						{{ Form::file('file_2', ['class' => 'form-control']) }}
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
						{{ Form::select('inbox_file_media', $master_options['media'], !empty($data['inbox_file_media']) ? $data['inbox_file_media'] : 'Kertas', ['class'=>'form-control select2_single']) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Bahasa</label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::select('inbox_file_language', $master_options['language'], !empty($data['inbox_file_language']) ? $data['inbox_file_language'] : 'Bahasa Indonesia', ['class'=>'form-control select2_single']) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Lampiran</label>
						<div class="col-sm-8 col-xs-12">
							<div class="row">
								<div class="col-xs-6">
								{{ Form::number('inbox_file_number', null, ['class'=>'form-control']) }}
								</div>
								<div class="col-xs-6">
								{{ Form::select('inbox_file_unit', $master_options['unit'], !empty($data['inbox_file_unit']) ? $data['inbox_file_unit'] : 'Lembar', ['class'=>'form-control select2_single']) }}
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Keterangan</label>
						<div class="col-sm-8 col-xs-12">
						{{ Form::text('inbox_file_note', null, ['class'=>'form-control']) }}
						</div>
					</div>
				</div>
			</div>
@if (in_array($profile['user_level'], [1,3,5]))
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Sekretaris</h6>
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
				{{ Form::bsEditor('inbox_secretary_note', "") }}
				</div>
			</div>
			</fieldset>
			<fieldset id="continue" style="display:none">
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Sifat Naskah</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::select('inbox_class', $master_options['class'], null, ['id'=>'inbox_class','class'=>'form-control select2_single']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tingkat Urgensi</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::select('inbox_level', $master_options['urgency'], null, ['id'=>'inbox_level','class'=>'form-control select2_single']) }}
				</div>
			</div>
			</fieldset>
@endif
@if (in_array($profile['user_level'], [1]))
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Administrator</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Status Posisi</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::select('inbox_status', $status_options, null, ['class'=>'form-control select2_single']) }}
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
	$('.category').on('ifChecked', function(event) {
		var action = $(this).val();
		if (action == "internal") {
			$('#senderInternal').show();
			$('#senderInternal :input').attr("disabled", false);
			$('#senderExternal').hide();
			$('#senderExternal :input').attr("disabled", true);
			$('#postExternal').show();
			$('#postExternal :input').attr("disabled", false);
			$('#postInstitute').hide();
			$('#postInstitute :input').attr("disabled", true);
		}
		else {
			$('#senderInternal').hide();
			$('#senderInternal :input').attr("disabled", true);
			$('#senderExternal').show();
			$('#senderExternal :input').attr("disabled", false);
			$('#postExternal').hide();
			$('#postExternal :input').attr("disabled", true);
			$('#postInstitute').show();
			$('#postInstitute :input').attr("disabled", false);
		}
	});

	$('#autonumber').click(function()
	{
		var data = new Object;
		data['_token'] = "{{ csrf_token() }}";

		$.ajax({
			type: "POST",
			url: "{{ url('headinbox/autonumber') }}",
			dataType: "html",
			data: data,
			success: function(data){
				$('#inbox_number').val(data);
			}
		});
	});

	$('#inbox_number').change(function()
	{
		if ($('#inbox_id').val() == "")
		{
			var data = new Object;
			data['_token'] = "{{ csrf_token() }}";
			data['id'] = $('#inbox_number').val();

			$.ajax({
				type: "POST",
				url: "{{ url('headinbox/checknumber') }}",
				dataType: "json",
				data: data,
				success: function(data){
					if (data['status'] == 1) {
						$('#inbox_number').val('');
						$('#inbox_number').focus();
						swal("Error!", data['description'], "error");
					}
				}
			});
		}
		return false;
	});

	$('#add_receiver').click(function() {
		var $template = $('#receiver_tmp').html();
		$('#receiver').append($template);

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

		$('.remove').click(function() {
			remove(this);
		});

		$('.type').change(function(){
			toggle(this);
		});
	});

	$('#add_cc').click(function() {
		var $template = $('#cc_tmp').html();
		$('#cc').append($template);

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

		$('.remove').click(function() {
			remove(this);
		});

		$('.type').change(function(){
			toggle(this);
		});
	});

	$('.view').click(function(){
		$('#title').html('Berkas Copy Digital');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('reportinbox/fileview') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});

	$('.download').click(function(){
		var file = $(this).attr('rel');
		if (/http/i.test(file)) {			
			var url = file;
		}
		else {
			var	url = "{{ url('reportinbox/filedownload') }}/" + file;
		}
		window.open(url);		
	});

	$('.remove').click(function() {
		remove(this);
	});
	
	function remove(id) {
		$(id).closest('div.input-form').remove();
	}

	$('.type').change(function(){
		toggle(this);
	});

	function toggle(id) {
		var input = $(id).closest('div');

		if ($(id).val() == "internal") {
			if (input.find('.receiver_name').hasClass('receiver') == false) {
				input.find('.receiver_name').addClass('receiver');
			}

			input.find('.receiver').autocomplete({
				serviceUrl: "{{ url('user/list/name') }}",
				onSelect: function (suggestion) {
					var input = $(id).closest('div');

					input.find('.receiver_id').val(suggestion.data);
					input.find('.receiver_post_id').val(suggestion.post_id);
					input.find('.receiver_post_type').val(suggestion.post_type);
					input.find('.receiver_post').val(suggestion.post_name);
					input.find('.receiver_unit').val(suggestion.post_unit);
				}
			});
		}
		else {
			input.find('.receiver').autocomplete('disable');
			input.find('.receiver_name').removeClass('receiver');
		}
	}

	$('#sender_post_name').autocomplete({
		serviceUrl: "{{ url('user/list/post') }}",
		onSelect: function (suggestion) {
			$('#sender_post_id').val(suggestion.post_id);
			$('#sender_post_name').val(suggestion.value);
			$('#sender_post_code').val(suggestion.post_code);
			$('#sender_post_unit').val(suggestion.post_unit);
			$('#agenda_unit').val(suggestion.data).change();
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
		}
	});

	$('#inbox_content').wysiwyg({});
	autosize($('#inbox_content'));

	$('#inbox_secretary_note').wysiwyg({});
	autosize($('#inbox_secretary_note'));

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
		$('#inbox_content_area').val($('#inbox_content').html());
		$('#inbox_secretary_note_area').val($('#inbox_secretary_note').html());

		$('[required]').each(function() {
			if (this.value.trim() == ""){
				hasError = true;
				$(this).attr('placeholder', "{{ trans('site.error_required') }}");
				$(this).focus();
				swal("Error!", "{{ trans('site.error_required') }}", "error");
			}
		});

		if ($('.checked input[name=inbox_category]').val() == "internal" && $('#sender_post_name').val() == ""){
			hasError = true;
			$('#sender_post_name').attr('placeholder', "{{ trans('site.error_required') }}");
			$('#sender_post_name').focus();
			swal("Error!", "{{ trans('site.error_required') }}", "error");
		}

		if ($('.checked input[name=inbox_category]').val() == "external" && $('#sender_post_ex').val() == ""){
			hasError = true;
			$('#sender_post_ex').attr('placeholder', "{{ trans('site.error_required') }}");
			$('#sender_post_ex').focus();
			swal("Error!", "{{ trans('site.error_required') }}", "error");
		}

		if ($('#agenda_class').val() == ""){
			hasError = true;
			$('#agenda_class').select2('open');
		}

		if ($('.checked input[name=inbox_category]').val() == "internal" && $('#agenda_unit').val() == ""){
			hasError = true;
			$('#agenda_unit').select2('open');
		}

		if ($('.checked input[name=inbox_category]').val() == "external" && $('#agenda_unit_ex').val() == ""){
			hasError = true;
			$('#agenda_unit_ex').select2('open');
		}

		if ($('#inbox_content_area').val() == "") {
			hasError = true;
			$('#inbox_content').focus();
			swal("Error!", "{{ trans('site.error_required') }}", "error");
		}

@if (in_array($profile['user_level'], [1,3,5]))
		if ($('.action').val()) {
			if ($('[name="action"]:checked').length <= 0) {
				hasError = true;
				$(this).focus();
				swal("Error!", "{{ trans('site.error_required') }}", "error");
			}
		}

		if ($('.checked input[name=action]').val() == "continue" && $('#inbox_class').val() == ""){
			hasError = true;
			$('#inbox_class').select2('open');
		}

		if ($('.checked input[name=action]').val() == "continue" && $('#inbox_level').val() == ""){
			hasError = true;
			$('#inbox_level').select2('open');
		}
@endif

		if (hasError == false){
			$('#form').submit();
		}

		return false;
	});
});
</script>
@endsection

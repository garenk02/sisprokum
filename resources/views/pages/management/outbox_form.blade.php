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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['outbox.update', $data['receiver_id']] : ['outbox.create', null], 'action'=>'OutboxController@save', 'class'=>'form-horizontal form-label-left', 'files'=>true]) }}
			{{ Form::hidden('outbox_id', null, ['id'=>'outbox_id']) }}
			{{ Form::hidden('receiver_id', null, ['id'=>'receiver_id']) }}			
			{{ Form::hidden('outbox_category', 'external') }} 
			{{ Form::hidden('outbox_method', null) }}
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
				{{ Form::select('outbox_type', $master_types, null, !empty($data['outbox_agenda_number']) ? ['id'=>'outbox_type','class'=>'form-control select2_single','disabled'=>true] : ['id'=>'outbox_type','class'=>'form-control select2_single','required'=>true]) }}
@if (!empty($data['outbox_agenda_number']))
				{{ Form::hidden('outbox_type', null) }}
@endif
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Sifat <span style="color:red">*</span></label>		
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('outbox_level', $master_options['urgency'], null, !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['id'=>'outbox_level','class'=>'form-control select2_single','disabled'=>true] : ['id'=>'outbox_level','class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Klafisikasi <span style="color:red">*</span></label>		
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('outbox_class', $master_options['class'], null, !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control select2_single','disabled'=>true] : ['class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>				
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Pengirim</h6>
			</div>		
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penandatangan <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::select('outbox_sender', $sender_options, !empty($data['outbox_sender_post_id']) ? $data['outbox_sender_post_id'] : null, !empty($data['outbox_agenda_number']) ? ['id'=>'outbox_sender','class'=>'form-control','disabled'=>true] : ['id'=>'outbox_sender','class'=>'form-control','required'=>true]) }}
				{{ Form::hidden('outbox_sender_id', !empty($data['outbox_sender_id']) ? $data['outbox_sender_id'] : $profile['user_id'], ['id'=>'sender_id','required'=>true]) }}
				{{ Form::hidden('outbox_sender_post_id', null, ['id'=>'sender_post_id']) }}
				{{ Form::hidden('outbox_sender_post_code', null, ['id'=>'sender_post_code']) }}
				{{ Form::hidden('outbox_sender_post_type', null, ['id'=>'sender_post_type']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Atas Nama</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::select('outbox_represent', $represent_options, !empty($data['outbox_represent']) ? $data['outbox_represent'] : "", !empty($data['outbox_agenda_number']) ? ['class'=>'form-control select2_single','disabled'=>true] : ['id'=>'represent','class'=>'form-control select2_single']) }}
				{{ Form::hidden('outbox_represent_id', null, ['id'=>'represent_id']) }}
				{{ Form::hidden('outbox_represent_code', null, ['id'=>'represent_code']) }}
				</div>
			</div>
@if ($profile['user_level'] <> 4 && (empty($data['outbox_method']) || $data['outbox_method'] == "attachment"))			
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Pemeriksa</h6>
			</div>		
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Pemeriksa 
@if (empty($data['outbox_agenda_number']))					
				<button type="button" id="add_corrector" class="btn btn-xs btn-info">+</button>
@endif
				</label>		
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="corrector">
@if (!empty($data['outbox_corrector']))
	@foreach ($data['outbox_corrector'] as $row => $corrector)
		@if (empty($data['outbox_agenda_number']))					
					<div class="row border-line input-form">
						<div class="input-group">
						{{ Form::text('outbox_corrector[]', $corrector['name'] . (!empty($corrector['post']) ? " | ".$corrector['post'] : "") . (!empty($corrector['code']) ? " | ".$corrector['code'] : "") . (!empty($corrector['unit']) ? " | ".$corrector['unit'] : ""), !empty($data['outbox_agenda_number']) ? ['class'=>'form-control corrector','disabled'=>true] : ['class'=>'form-control corrector']) }} 
						{{ Form::hidden('outbox_corrector_ids[]', !empty($corrector['id']) ? $corrector['id'] : 0, ['class'=>'corrector_id']) }}
						{{ Form::hidden('outbox_corrector_posts[]', !empty($corrector['post_id']) ? $corrector['post_id'] : 0, ['class'=>'corrector_post_id']) }}
						<span class="input-group-btn">
						<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
						</span>
						</div>
					</div>	
		@else
					<div class="border-line">
					{{ Form::text('outbox_corrector[]', $corrector['name'] . (!empty($corrector['post']) ? " | ".$corrector['post'] : "") . (!empty($corrector['code']) ? " | ".$corrector['code'] : "") . (!empty($corrector['unit']) ? " | ".$corrector['unit'] : ""), !empty($data['outbox_agenda_number']) ? ['class'=>'form-control corrector','disabled'=>true] : ['class'=>'form-control corrector']) }} 
					{{ Form::hidden('outbox_corrector_ids[]', !empty($corrector['id']) ? $corrector['id'] : 0, ['class'=>'corrector_id']) }}
					{{ Form::hidden('outbox_corrector_posts[]', !empty($corrector['post_id']) ? $corrector['post_id'] : 0, ['class'=>'corrector_post_id']) }}
					</div>		
		@endif					
	@endforeach
@else
	@if (empty($data['outbox_agenda_number']) && (empty($data['outbox_method']) || $data['outbox_method'] == "attachment"))					
					<div class="row border-line input-form">	
						<div class="input-group">
						{{ Form::text('outbox_corrector[]', "", !empty($data['outbox_agenda_number']) ? ['class'=>'form-control corrector','disabled'=>true] : ['class'=>'form-control corrector']) }} 
						{{ Form::hidden('outbox_corrector_ids[]', "", ['class'=>'corrector_id']) }}
						{{ Form::hidden('outbox_corrector_posts[]', "", ['class'=>'corrector_post_id']) }}
						<span class="input-group-btn">
						<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
						</span>
						</div>
					</div>
	@endif
@endif	
					</fieldset>
					<fieldset id="corrector_tmp" style="display: none">
@if (empty($data['outbox_agenda_number']) && (empty($data['outbox_method']) || $data['outbox_method'] == "attachment"))					
					<div class="row border-line input-form">
						<div class="input-group">
						{{ Form::text('outbox_corrector[]', "", ['class'=>'form-control corrector']) }} 
						{{ Form::hidden('outbox_corrector_ids[]', "", ['class'=>'corrector_id']) }}
						<span class="input-group-btn">
						<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
						</span>
						</div>					
					</div>
@endif					
					</fieldset>
				</div>
			</div>		
@endif			
@if (in_array($profile['user_level'], [1,4]))
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Nomor Surat</h6>
			</div>
@if (!empty($data['outbox_agenda_number']))
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Surat <span style="color:red">*</span></label>		
				<div class="col-md-10 col-sm-9 col-xs-12">
					<div class="row">
						<div class="col-sm-2 col-xs-12">
						<p>No Urut</p>
						{{ Form::text('outbox_agenda_number', !empty($data['outbox_agenda_number']) ? $data['outbox_agenda_number'] : $agenda_number, ['id'=>'agenda_number','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','required'=>true]) }}
						</div>
						<div class="col-sm-4 col-xs-12">
						<p>Klasifikasi</p>
						{{ Form::select('outbox_agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control select2_group','tabindex'=>'-1']) }}
						</div>
						<div class="col-sm-4 col-xs-12">
						<p>Kode Unit</p>
						{{ Form::select('outbox_agenda_unit', $post_internal_options, !empty($data['outbox_agenda_unit']) ? $data['outbox_agenda_unit'] : null, ['id'=>'agenda_unit','class'=>'form-control select2_group','tabindex'=>'-1']) }}						
						</div>
						<div class="col-sm-2 col-xs-12">
						<p>Tahun</p>
						{{ Form::text('outbox_agenda_year', !empty($data['outbox_agenda_year']) ? $data['outbox_agenda_year'] : date('Y'), ['id'=>'agenda_year','class'=>'form-control','onclick'=>'blur()','onfocus'=>'blur()','required'=>true]) }}
						</div>	
					</div>					
				</div>
			</div>
@else
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Klasifikasi <span style="color:red">*</span></label>		
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('outbox_agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control select2_group','tabindex'=>'-1']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Kode Unit <span style="color:red">*</span></label>		
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::select('outbox_agenda_unit', $post_internal_options, !empty($data['outbox_agenda_unit']) ? $data['outbox_agenda_unit'] : null, ['id'=>'agenda_unit','class'=>'form-control select2_group','tabindex'=>'-1']) }}						
				{{ Form::hidden('outbox_agenda_year', !empty($data['outbox_agenda_year']) ? $data['outbox_agenda_year'] : date('Y')) }}
				</div>
			</div>
@endif
@else
			{{ Form::hidden('outbox_agenda_unit', null, ['id'=>'agenda_unit_id']) }}
@endif				
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Penerima dan Tembusan</h6>
			</div>		
			<fieldset id="broadcast">				
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">&nbsp;</label>		
				<div class="col-md-4 col-sm-5 col-xs-12">
				{{ Form::checkbox('outbox_broadcast', 'yes', null, !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'flat','disabled'=>true] : ['class'=>'flat']) }}
				{{ Form::label('outbox_broadcast', 'Kirim ke seluruh Staf') }}
				</div>
			</div>
			</fieldset>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penerima 
@if (empty($data['outbox_agenda_number']) || $data['outbox_method'] == "booking")				
					<button type="button" id="add_receiver" class="btn btn-xs btn-info">+</button>
@endif
				</label>		
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="receiver">
@if (!empty($data['outbox_receiver']))
	@foreach ($data['outbox_receiver'] as $row => $receiver)
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<p>{{ Form::select('receiver[type][]', $type_options, !empty($receiver['type']) ? $receiver['type'] : null, !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control type']) }}</p>						
							<label for="name">Nama</label>		
							{{ Form::hidden('receiver[id][]', !empty($receiver['id']) ? $receiver['id'] : "", ['class'=>'receiver_id']) }}
							{{ Form::text('receiver[name][]', $receiver['name'], !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : (!empty($receiver['type']) && $receiver['type'] == "internal" ? ['class'=>'form-control receiver_name receiver'] : ['class'=>'form-control receiver_name'])) }}					
							<label for="post_name">Jabatan</label>	
							{{ Form::hidden('receiver[post_id][]', !empty($receiver['post_id']) ? $receiver['post_id'] : "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('receiver[post_type][]', !empty($receiver['post_type']) ? $receiver['post_type'] : "", ['class'=>'receiver_post_type']) }}								
							{{ Form::text('receiver[post][]', $receiver['post'], !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('receiver[unit][]', $receiver['unit'], !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
@if (empty($data['outbox_agenda_number']) || $data['outbox_method'] == "booking")										
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
@endif
						</div>
					</div>
	@endforeach
@else					
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<p>{{ Form::select('receiver[type][]', $type_options, "", !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control type']) }}</p>						
							<label for="name">Nama</label>		
							{{ Form::hidden('receiver[id][]', "", ['class'=>'receiver_id']) }}							
							{{ Form::text('receiver[name][]', "", !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_name']) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('receiver[post_id][]', "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('receiver[post_type][]', "", ['class'=>'receiver_post_type']) }}								
							{{ Form::text('receiver[post][]', "", !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('receiver[unit][]', "", !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
@if (empty($data['outbox_agenda_number']) || $data['outbox_method'] == "booking")				
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
@endif
						</div>
					</div>
@endif
					</fieldset>			
					<fieldset id="receiver_tmp" style="display: none">
@if (empty($data['outbox_agenda_number']) || $data['outbox_method'] == "booking")					
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<p>{{ Form::select('receiver[type][]', $type_options, "", ['class'=>'form-control type']) }}</p>
							<label for="name">Nama</label>	
							{{ Form::hidden('receiver[id][]', "", ['class'=>'receiver_id']) }}		
							{{ Form::text('receiver[name][]', "", ['class'=>'form-control receiver_name']) }}					
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
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tembusan 
@if (empty($data['outbox_agenda_number']) || $data['outbox_method'] == "booking")
					<button type="button" id="add_cc" class="btn btn-xs btn-info">+</button>
@endif
				</label>		
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="cc">
@if (!empty($data['outbox_cc']))
	@foreach ($data['outbox_cc'] as $row => $cc)
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<p>{{ Form::select('cc[type][]', $type_options, !empty($cc['type']) ? $cc['type'] : null, !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control type']) }}</p>						
							<label for="name">Nama</label>		
							{{ Form::hidden('cc[id][]', !empty($cc['id']) ? $cc['id'] : "", ['class'=>'receiver_id']) }}
							{{ Form::text('cc[name][]', $cc['name'], !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : (!empty($cc['type']) && $cc['type'] == "internal" ? ['class'=>'form-control receiver_name receiver'] : ['class'=>'form-control receiver_name'])) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('cc[post_id][]', !empty($cc['post_id']) ? $cc['post_id'] : "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('cc[post_type][]', !empty($cc['post_type']) ? $cc['post_type'] : "", ['class'=>'receiver_post_type']) }}														
							{{ Form::text('cc[post][]', $cc['post'], !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('cc[unit][]', $cc['unit'], !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
@if (empty($data['outbox_agenda_number']) || $data['outbox_method'] == "booking")						
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
@endif
						</div>						
					</div>
	@endforeach
@else					
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<p>{{ Form::select('cc[type][]', $type_options, "", !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control type']) }}</p>
							<label for="name">Nama</label>		
							{{ Form::hidden('cc[id][]', "", ['class'=>'receiver_id']) }}
							{{ Form::text('cc[name][]', "", !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_name']) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('cc[post_id][]', "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('cc[post_type][]', "", ['class'=>'receiver_post_type']) }}							
							{{ Form::text('cc[post][]', "", !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('cc[unit][]', "", !empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking" ? ['class'=>'form-control','disabled'=>true] : ['class'=>'form-control receiver_unit']) }}
						</div>	
						<div class="col-xs-1">
@if (empty($data['outbox_agenda_number']) || $data['outbox_method'] == "booking")						
							<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>					
@endif
						</div>
					</div>
@endif
					</fieldset>				
					<fieldset id="cc_tmp" style="display: none">
@if (empty($data['outbox_agenda_number']) || $data['outbox_method'] == "booking")					
					<div class="row border-line input-form">
						<div class="col-xs-11">
							<p>{{ Form::select('cc[type][]', $type_options, "", ['class'=>'form-control type']) }}</p>
							<label for="name">Nama</label>		
							{{ Form::hidden('cc[id][]', "", ['class'=>'receiver_id']) }}
							{{ Form::text('cc[name][]', "", ['class'=>'form-control receiver_name']) }}					
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
				</div>
			</div>	
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Hal</h6>
			</div>		
			<div class="form-group">
				<div class="col-xs-12">
@if (!empty($data['outbox_agenda_number']) && $data['outbox_method'] <> "booking")
				<div class="well">{!! !empty($data['outbox_content']) ? $data['outbox_content'] : "" !!}</div>
@else	
				{{ Form::bsEditor('outbox_content', !empty($data['outbox_content']) ? $data['outbox_content'] : null) }}
@endif
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
							{{ Form::textarea('outbox_meta_reference', null, ['class'=>'form-control','rows'=>3]) }}
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
						{{ Form::select('outbox_file_language', $master_options['language'], !empty($data['outbox_file_language']) ? $data['outbox_file_language'] : 'Bahasa Indonesia', ['class'=>'form-control select2_single']) }}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Lampiran</label>		
						<div class="col-sm-8 col-xs-12">
							<div class="row">
								<div class="col-xs-6">
								{{ Form::number('outbox_file_number', null, ['class'=>'form-control']) }}
								</div>
								<div class="col-xs-6">
								{{ Form::select('outbox_file_unit', $master_options['unit'], !empty($data['outbox_file_unit']) ? $data['outbox_file_unit'] : 'Lembar', ['class'=>'form-control select2_single']) }}
								</div>								
							</div>
						</div>
					</div>					
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Keterangan</label>		
						<div class="col-sm-8 col-xs-12">
						{{ Form::text('outbox_file_note', null, ['class'=>'form-control']) }}
						</div>
					</div>					
				</div>
			</div>
@endif
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">File Surat</h6>
			</div>		
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
				<div class="row">
					<div class="input-group input-form">
					{{ Form::text('outbox_meta_files[]', $file, ['class'=>'form-control receiver', 'onclick'=>'blur()', 'onfocus'=>'blur()']) }}
					<span class="input-group-btn">
					<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-info view" rel="{{ $file }}"><i class="fa fa-eye"></i></button>
					<button type="button" class="btn btn-success download" rel="{{ $file }}"><i class="fa fa-download"></i></button>
					<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
					</span>
					</div>		
				</div>
@endforeach
@endif
				{{ Form::file('file_1', empty($data['outbox_meta_files']) ? ['class' => 'form-control','required'=>true] : ['class' => 'form-control']) }}
				{{ Form::file('file_2', ['class' => 'form-control']) }}
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
			{{ Form::hidden('outbox_corrector_prev', null) }}				
			{{ Form::hidden('outbox_corrector_next', null) }}			
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
				<div class="col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-3 col-xs-12">
					<em><span style="color:red">*</span> <small>{{ trans('site.required') }}</small></em><br/>
					<em><span style="color:grey">**</span> <small>Pengajuan Surat diatas Pukul 16.00 WIB akan diproses pada hari berikutnya </small></em>
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
	$('#add_receiver').click(function() {
		var $template = $('#receiver_tmp').html();
		$('#receiver').append($template);
	
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
		
		$('.remove').click(function() {
			remove(this);
		});			
		
		$('.type').change(function(){
			toggle(this);
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
	
	$('#outbox_sender').change(function() {
		var array = $('#outbox_sender').val().split('-');
		$('#sender_post_id').val(array[0]);
		$('#sender_post_code').val(array[1]);
		$('#agenda_unit_id').val($('#sender_post_code').val());
		$('#agenda_unit').val($('#sender_post_code').val()).change();			
	});	
				
	$('.sender').autocomplete({
		serviceUrl: "{{ url('user/list/name') }}",
		onSelect: function (suggestion) {
			$('#sender_id').val(suggestion.data);
			$('#sender_post_id').val(suggestion.post_id);
			$('#sender_post_code').val(suggestion.post_code);
			$('#sender_post_type').val(suggestion.post_type);			
			if ($('#represent_code').val() != ""){
				$('#agenda_unit_id').val($('#represent_code').val());
				$('#agenda_unit').val($('#represent_code').val()).change();				
			}
			else {
				$('#agenda_unit_id').val(suggestion.post_code);
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

	$('#outbox_content').wysiwyg({});
	autosize($('#outbox_content'));
	
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
		$('#outbox_content_area').val($('#outbox_content').html());
		$('#note_area').val($('#note').html());			
		
		$('[required]').each(function() {
			if (this.value.trim() == ""){ 
				hasError = true;
				$(this).attr('placeholder', "{{ trans('site.error_required') }}");
				$(this).focus();				
				swal("Error!", "{{ trans('site.error_required') }}" /* + $(this).attr('name') */, "error");							
			}
		});						
				
		if ($('#outbox_content_area').val() == "") {
			hasError = true;
			$('#outbox_content').focus();				
			swal("Error!", "{{ trans('site.error_required') }}", "error");				
		}		
		
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
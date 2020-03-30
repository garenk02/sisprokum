<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_content text-left">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['outbox.update', $data['receiver_id']] : ['outbox.create', null], 'action'=>'OutboxController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('outbox_id', null, ['id'=>'outbox_id']) }}
			<div class="row">
				<div class="form-group bg-blue-grey">
					<h6 class="text-center">Data Surat</h6>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Nomor Agenda') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_agenda'] }}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tanggal Surat') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_date_text'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Hal') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['outbox_content'] !!}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Sifat Naskah') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_level'] }}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pengirim') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_sender_name']." | ".$data['outbox_sender_post_name'].(!empty($data['outbox_sender_post_type']) ? " (".$data['outbox_sender_post_type'].")" : "")." | ".$data['outbox_sender_post_unit'] }}</div>
				</div>	
@if (!empty($data['outbox_represent_id']))
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Atas Nama') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_represent_code']." | ".$data['outbox_represent_name']." | ".$data['outbox_represent_unit'] }}</div>
					</div>
@endif
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Penerima') }}</div>
					<div class="col-sm-9 col-xs-8">
@if ($data['outbox_broadcast'] == "yes")
					Seluruh Staf
@else
					<ul class="list-unstyled">
@foreach ($data['outbox_receiver'] as $receiver)
						<li>- {{ $receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
@endforeach
					</ul>
@endif
					</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tembusan') }}</div>
					<div class="col-sm-9 col-xs-8">
					<ul class="list-unstyled">
@foreach ($data['outbox_cc'] as $receiver)
						<li>- {{ $receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
@endforeach
					</ul>
					</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Copy Digital') }}</div>
					<div class="col-sm-9 col-xs-8">
					<ul class="list-unstyled">
@foreach ($data['outbox_meta_files'] as $file)
@if ($source == "app")
						<a href="{{ preg_match('/http/i', $file) ? $file : asset('uploads/'.$file) }}" class="btn btn-xs btn-success" title="Lihat Berkas"><i class="fa fa-eye"></i></a> 
@else
						<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-xs btn-success view" rel="{{ $file }}" title="Lihat Berkas"><i class="fa fa-eye"></i></button> 
						<button type="button" class="btn btn-xs btn-info download" rel="{{ $file }}" title="Unduh Berkas"><i class="fa fa-download"></i></button>
@endif
@endforeach
					</ul>
					</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Lampiran') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_file_number']." ".$data['outbox_file_unit']. (!empty($data['outbox_file_note']) ? " | ".$data['outbox_file_note'] : "") }}</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Lokasi Fisik') }}</div>
					<div class="col-sm-9 col-xs-8">Tata Usaha 
@foreach ($data['outbox_receiver'] as $row => $receiver)
					{{ !empty($receiver['code']) ? ($row == 0 ? $receiver['code'] : ", ".$receiver['code']) : "" }}
@endforeach
@foreach ($data['outbox_cc'] as $row => $cc)
					{{ !empty($cc['code']) ? ($row == 0 && sizeof($data['outbox_receiver']) == 0 ? $cc['code'] : ", ".$cc['code']) : "" }}
@endforeach
					</div>
				</div>			
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Retensi Aktif') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_meta_active_date_text'] }}</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Retensi In-Aktif') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_meta_inactive_date_text'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Dasar Hukum Retensi') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['outbox_meta_reference'] !!}</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Bahasa') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_file_language'] }}</div>
				</div>				
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pengonsep Draft') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_register_name'] }} <span class="pull-right"><small>{{ $data['outbox_register_date_text'] }}</small></span></div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Petugas Registrasi') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_operator_name'] }} <span class="pull-right"><small>{{ $data['outbox_operator_date_text'] }}</small></span></div>
				</div>	
@if (!empty($data['outbox_status']) && ($data['outbox_status'] == "draft" || $data['outbox_status'] == "corrector" || $data['outbox_status'] == "user"))				
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pengoreksi') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_corrector_name'] }} <span class="pull-right"><small>{{ $data['outbox_verificator_date_text'] }}</small></span></div>
				</div>
@if (!empty($data['outbox_corrector_note']) && $data['outbox_status'] == "draft" || $data['outbox_status'] == "corrector")
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Nota Pengoreksi') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['outbox_corrector_note'] !!}</div>
				</div>
@endif					
@else
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pemeriksa') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['outbox_verificator_name'] }} <span class="pull-right"><small>{{ $data['outbox_verificator_date_text'] }}</small></span></div>
				</div>
@if (!empty($data['outbox_verificator_note']))
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Nota Pemeriksa') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['outbox_verificator_note'] !!}</div>
				</div>
@endif		
@endif		
			</div>
			{{ Form::close() }}
		  </div>
		</div>
	</div>
</div>

<script language="javascript">
$(document).ready(function() 
{
	$('.dlfile').click(function(){
		var	url = "{{ url('outbox/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});	
});	
</script>

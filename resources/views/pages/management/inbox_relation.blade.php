<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_content text-left">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['inbox.update', $data['receiver_id']] : ['inbox.create', null], 'action'=>'HeadInboxController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('inbox_id', null, ['id'=>'inbox_id']) }}
			{{ Form::hidden('receiver_id', null, ['id'=>'receiver_id']) }}	
			<div class="row">
				<div class="form-group bg-blue-grey">
					<h6 class="text-center">Data Surat</h6>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Nomor Agenda') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_agenda'] }}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tanggal Agenda') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_agenda_date_text'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Nomor Surat') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_number'] }}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tanggal Surat') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_date_text'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Hal') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['inbox_content'] !!}</div>
				</div>			
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Sifat Naskah') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_class'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tingkat Urgensi') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_level'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pengirim') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_sender_name']." | ".$data['inbox_sender_post_name']." | ".$data['inbox_sender_post_unit'] }}</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Penerima') }}</div>
					<div class="col-sm-9 col-xs-8">
					<ul class="list-unstyled">
@foreach ($data['inbox_receiver'] as $receiver)
						<li>{{ (sizeof($data['inbox_receiver']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit']  }}</li>
@endforeach
					</ul>
					</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tembusan') }}</div>
					<div class="col-sm-9 col-xs-8">
					<ul class="list-unstyled">
@foreach ($data['inbox_cc'] as $receiver)
						<li>{{ (sizeof($data['inbox_cc']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit']  }}</li>
@endforeach
					</ul>
					</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Kategori Naskah') }}</div>
					<div class="col-sm-9 col-xs-8">{{ ucwords($data['inbox_category']) }}</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Perkembangan') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_meta_type'] }}</div>
				</div>	
<!--				
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Copy Digital') }}</div>
					<div class="col-sm-9 col-xs-8">
					<ul class="list-unstyled">
@foreach ($data['inbox_meta_files'] as $file)
						<li>{{ $file }}
@if ($source == "app")
						<a href="{{ preg_match('/http/i', $file) ? $file : asset('uploads/'.$file) }}" class="btn btn-xs btn-success" title="Lihat Berkas"><i class="fa fa-eye"></i></a> 
@else
						<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-xs btn-success view" rel="{{ $file }}" title="Lihat Berkas"><i class="fa fa-eye"></i></button> 
						<button type="button" class="btn btn-xs btn-info download" rel="{{ $file }}" title="Unduh Berkas"><i class="fa fa-download"></i></button>
@endif
						</li>
@endforeach
					</ul>
					</div>
				</div>					
-->
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Lampiran') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_file_number']." ".$data['inbox_file_unit'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Lokasi Fisik') }}</div>
					<div class="col-sm-9 col-xs-8">Tata Usaha 
@foreach ($data['inbox_receiver'] as $row => $receiver)
					{{ !empty($receiver['code']) ? ($row == 0 ? $receiver['code'] : ", ".$receiver['code']) : "" }}
@endforeach
@foreach ($data['inbox_cc'] as $row => $cc)
					{{ !empty($cc['code']) ? ($row == 0 && sizeof($data['inbox_receiver']) == 0 ? $cc['code'] : ", ".$cc['code']) : "" }}
@endforeach
					</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Retensi Aktif') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_meta_active_date_text'] }}</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Retensi In-Aktif') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_meta_inactive_date_text'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Media Arsip') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_file_media'] }}</div>
				</div>			
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Bahasa') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_file_language'] }}</div>
				</div>		
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Petugas Registrasi') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_register_name'] }} <span class="pull-right"><small>{{ $data['inbox_register_date_text'] }}</small></span></div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Sekretaris') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_secretary_name'] }} <span class="pull-right"><small>{{ $data['inbox_secretary_date_text'] }}</small></span></div>
				</div>
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
		var	url = "{{ url('inbox/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});	
});	
</script>

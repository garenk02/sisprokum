@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ trans('site.data_detail') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['headinbox.update', $data['receiver_id']] : ['headinbox.create', null], 'action'=>'HeadInboxController@save', 'class'=>'form-horizontal form-label-left']) }}
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
						<li>{{ (sizeof($data['inbox_receiver']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
@endforeach
					</ul>
					</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tembusan') }}</div>
					<div class="col-sm-9 col-xs-8">
					<ul class="list-unstyled">
@foreach ($data['inbox_cc'] as $receiver)
						<li>{{ (sizeof($data['inbox_cc']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
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
@if ($profile['user_level'] <> 4)				
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
@endif
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Lampiran') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['inbox_file_number']." ".$data['inbox_file_unit']. (!empty($data['inbox_file_note']) ? " | ".$data['inbox_file_note'] : "") }}</div>
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
					<div class="col-sm-3 col-xs-4">{{ Form::label('Dasar Hukum Retensi') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['inbox_meta_reference'] !!}</div>
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
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
@if ($source <> "app")
					<button type="button" id="print" class="btn btn-info m-t-15 waves-effect"><i class="fa fa-print"></i> {{ trans('site.print') }}</button>
@endif
					<button type="button" id="back" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-undo"></i> {{ trans('site.back') }}</button>
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

	$('#print').click(function() {
		var url = "{{ url('reportinbox/print/'.$data['receiver_id']) }}";
		window.open(url);
	});
});
</script>
@endsection

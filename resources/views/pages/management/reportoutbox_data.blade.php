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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['outbox_id']) ? ['outbox.update', $data['outbox_id']] : ['outbox.create', null], 'action'=>'OutboxController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('outbox_id', null, ['id'=>'outbox_id']) }}
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Data Surat</h6>
					</div>						
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Nomor') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_agenda'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Tanggal') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_date_text'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Hal') }}</div>
						<div class="col-sm-8 col-xs-7">{!! $data['outbox_content'] !!}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Sifat') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_level'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Pengirim') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_sender_name']." | ".$data['outbox_sender_post_name'].(!empty($data['outbox_sender_post_type']) ? " (".$data['outbox_sender_post_type'].")" : "")." | ".$data['outbox_sender_post_unit'] }}</div>
					</div>
@if (!empty($data['outbox_represent_id']))
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Atas Nama') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_represent_code']." | ".$data['outbox_represent_name']." | ".$data['outbox_represent_unit'] }}</div>
					</div>
@endif
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Penerima') }}</div>
						<div class="col-sm-8 col-xs-7">
						<ul class="list-unstyled">
@foreach ($data['outbox_receiver'] as $receiver)
							<li>{{ (sizeof($data['outbox_receiver']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
@endforeach
						</ul>
						</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Tembusan') }}</div>
						<div class="col-sm-8 col-xs-7">
						<ul class="list-unstyled">
@foreach ($data['outbox_cc'] as $receiver)
							<li>{{ (sizeof($data['outbox_cc']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
@endforeach
						</ul>
						</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Copy Digital') }}</div>
						<div class="col-sm-8 col-xs-7">
						<ul class="list-unstyled">
@foreach ($data['outbox_meta_files'] as $file)
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
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Lampiran') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_file_number']." ".$data['outbox_file_unit']. (!empty($data['outbox_file_note']) ? " | ".$data['outbox_file_note'] : "") }}</div>
					</div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">&nbsp;</h6>
					</div>				
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Lokasi Fisik') }}</div>
						<div class="col-sm-8 col-xs-7">Tata Usaha
@foreach ($data['outbox_receiver'] as $row => $receiver)
					{{ !empty($receiver['code']) ? ($row == 0 ? $receiver['code'] : ", ".$receiver['code']) : "" }}
@endforeach
@foreach ($data['outbox_cc'] as $row => $cc)
					{{ !empty($cc['code']) ? ($row == 0 && sizeof($data['outbox_receiver']) == 0 ? $cc['code'] : ", ".$cc['code']) : "" }}
@endforeach
						</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Retensi Aktif') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_meta_active_date_text'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Retensi In-Aktif') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_meta_inactive_date_text'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Dasar Hukum Retensi') }}</div>
						<div class="col-sm-8 col-xs-7">{!! $data['outbox_meta_reference'] !!}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Bahasa') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_file_language'] }}</div>
					</div>
@if ($data['outbox_method'] == "attachment")
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Pengonsep') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_register_name'] }} <span class="pull-right"><small>{{ $data['outbox_register_date_text'] }}</small></span></div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Pengoreksi') }}</div>
						<div class="col-sm-8 col-xs-7">
						<ul class="list-unstyled">
@foreach ($data['outbox_corrector'] as $corrector)
							<li>{{ (sizeof($data['outbox_corrector']) > 1 ? "- " : "").$corrector['name']." | ".$corrector['post']." | ".$corrector['unit'] }}</li>
@endforeach
						</ul>
						</div>
					</div>
@endif
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Petugas Registrasi') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_operator_name'] }} <span class="pull-right"><small>{{ $data['outbox_operator_date_text'] }}</small></span></div>
					</div>
					<div class="form-group form-line">
						<div class="col-sm-4 col-xs-5">{{ Form::label('Pemeriksa') }}</div>
						<div class="col-sm-8 col-xs-7">{{ $data['outbox_verificator_name'] }} <span class="pull-right"><small>{{ $data['outbox_verificator_date_text'] }}</small></span></div>
					</div>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
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
});
</script>
@endsection

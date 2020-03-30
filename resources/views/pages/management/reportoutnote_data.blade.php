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
			{{ Form::model($data, ['id'=>'form', 'route'=> !empty($data['receiver_id']) ? ['outnote.update', $data['receiver_id']] : ['outnote.create', null], 'action'=>'InnoteController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('memo_id', null, ['id'=>'memo_id']) }}
			{{ Form::hidden('receiver_id', null, ['id'=>'receiver_id']) }}
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Data Surat</h6>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Nomor') }}</div>
						<div class="col-xs-8">{{ $data['memo_agenda'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Tanggal') }}</div>
						<div class="col-xs-8">{{ $data['memo_date_text'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Hal') }}</div>
						<div class="col-xs-8">{{ $data['memo_title'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Sifat') }}</div>
						<div class="col-xs-8">{{ $data['memo_level'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Lampiran') }}</div>
						<div class="col-xs-8">{{ $data['memo_file_note'] }}</div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Pengirim') }}</div>
						<div class="col-xs-8">{{ $data['memo_sender_name']." | ".$data['memo_sender_post_name'].(!empty($data['memo_sender_post_type']) ? " (".$data['memo_sender_post_type'].")" : "")." | ".$data['memo_sender_post_unit'] }}</div>
					</div>
@if (!empty($data['memo_represent_id']))
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Atas Nama') }}</div>
						<div class="col-xs-8">{{ $data['memo_represent_code']." | ".$data['memo_represent_name']." | ".$data['memo_represent_unit'] }}</div>
					</div>
@endif
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Penerima') }}</div>
						<div class="col-xs-8">
						<ul class="list-unstyled">
@foreach ($data['memo_receiver'] as $receiver)
						<li>{{ (sizeof($data['memo_receiver']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
@endforeach
						</ul>
						</div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Tembusan') }}</div>
						<div class="col-xs-8">
						<ul class="list-unstyled">
@foreach ($data['memo_cc'] as $receiver)
						<li>{{ (sizeof($data['memo_cc']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
@endforeach
						</ul>
						</div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Lampiran Relasi') }}</div>
						<div class="col-xs-8">
@if (!empty($data['memo_relation']))
						<ul class="list-unstyled">
@foreach ($data['memo_relation'] as $relation)
						<li>{{ $relation['relation_agenda'] }} | <button type="button" data-toggle="modal" data-target="#popup" class="btn btn-xs btn-success peek-{{ $relation['relation_type'] }}" rel="{{ $relation['relation_agenda'] }}" title="Lihat Relasi"><i class="fa fa-eye"></i></button></li>
@endforeach
						</ul>
@endif
						</div>
					</div>					
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Copy Digital') }}</div>
						<div class="col-xs-8">
						<ul class="list-unstyled">
@foreach ($data['memo_meta_files'] as $file)
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
<!--
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Lokasi Fisik') }}</div>
						<div class="col-xs-8">Tata Usaha
@foreach ($data['memo_receiver'] as $row => $receiver)
					{{ !empty($receiver['code']) ? ($row == 0 ? $receiver['code'] : ", ".$receiver['code']) : "" }}
@endforeach
@foreach ($data['memo_cc'] as $row => $cc)
					{{ !empty($cc['code']) ? ($row == 0 && sizeof($data['memo_receiver']) == 0 ? $cc['code'] : ", ".$cc['code']) : "" }}
@endforeach
						</div>
					</div>
-->
<!--
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Pengonsep') }}</div>
						<div class="col-xs-8">{{ $data['memo_register_name'] }} <span class="pull-right"><small>{{ $data['memo_register_date_text'] }}</small></span></div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Pemeriksa') }}</div>
						<div class="col-xs-8">
						<ul class="list-unstyled">
@foreach ($data['memo_corrector'] as $corrector)
						<li>{{ (sizeof($data['memo_corrector']) > 1 ? "-" : "").$corrector['code']." | ".$corrector['name'] }}</li>
@endforeach
						</ul>
						</div>
					</div>
@if (!empty($data['memo_corrector_note']) && $data['memo_status'] <> "done" && ($data['user_status'] == "drafter" || $data['user_status'] == "corrector"))
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Pemeriksa Terakhir') }}</div>
						<div class="col-xs-8">{{ $data['memo_corrector_name'] }} <span class="pull-right"><small>{{ $data['memo_corrector_date_text'] }}</small></span></div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Komentar Pemeriksa') }}</div>
						<div class="col-xs-8">{!! $data['memo_corrector_note'] !!}</div>
					</div>
@endif
-->
				</div>
<!--			
				<div class="col-sm-6 col-xs-12">
					<div id="accordion" class="accordion" role="tablist">
						<div class="form-group bg-blue-grey">
							<a href="#history" role="tab" data-toggle="collapse" data-parent="#accordion" class="accordion-title">
							<h6 class="text-center">Jejak</h6>
							</a>
						</div>
						<div id="history" class="panel-collapse collapse" role="tabpanel">
@if (!empty($data['memo_disposition']))
@foreach ($data['memo_disposition'] as $disposition)
	@if ($disposition['disposition_status'] <> "end")
							<div class="form-group form-line">
								<div class="col-xs-12">
								{{ Form::label($disposition['disposition_date']) }}
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Disposisi Dari') }}
								</div>
								<div class="col-xs-8">
								{{ $disposition['disposition_parent']['post_code']." | ".$disposition['disposition_parent']['name'] }}
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Kepada') }}
								</div>
								<div class="col-xs-8">
								<ul class="list-unstyled">
		@if (!empty($disposition['disposition_user']))
		@foreach ($disposition['disposition_user'] as $duser)
								<li>{!! $duser !!}</li>
		@endforeach
		@endif
								</ul>
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Arahan Disposisi') }}
								</div>
								<div class="col-xs-8">
								<ul class="list-unstyled">
		@if (!empty($disposition['disposition_direction']))
		@foreach ($disposition['disposition_direction'] as $direction)
								<li>- {{ $direction }}</li>
		@endforeach
		@endif
								</ul>
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Catatan') }}
								</div>
								<div class="col-xs-8">
								{!! $disposition['disposition_note'] !!}
								</div>
							</div>
		@if (!empty($disposition['disposition_doner']))
		@foreach ($disposition['disposition_doner'] as $doner)
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Diselesaikan Oleh') }}
								</div>
								<div class="col-xs-8">
								{{ $doner['post_code']." | ".$doner['name'] }} <span class="pull-right"><small>{{ $doner['date'] }}</small></span>
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Catatan') }}
								</div>
								<div class="col-xs-8">
								{!! $doner['note'] !!}
								</div>
							</div>
		@endforeach
		@endif
		@if (!empty($disposition['disposition_comment']))
							<div class="form-group form-line">
								<div class="col-xs-12">
								{{ Form::label('Tanggapan') }}
								</div>
		@foreach ($disposition['disposition_comment'] as $comment)
								<div class="col-xs-12">
									<div class="well">
									<p><b>{{ $comment['comment_user_name'] }}</b> <span class="pull-right"><small>- {{ $comment['comment_date'] }}</small></span></p>
									<p>{{ $comment['comment_note'] }}</p>
									</div>
								</div>
		@endforeach
							</div>
		@endif
	@endif
							<p>&nbsp;</p>
@endforeach
@endif
@if ($data['receiver_type'] <> "disposition" && $data['receiver_status'] == "done")
							<div class="form-group form-line">
								<div class="col-xs-12">
								{{ Form::label($data['receiver_done_date']) }}
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Diselesaikan Oleh') }}
								</div>
								<div class="col-xs-8">
								{{ $data['receiver_done_post_code']." | ".$data['receiver_done_name'] }}
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Catatan') }}
								</div>
								<div class="col-xs-8">
								{!! $data['receiver_done_note'] !!}
								</div>
							</div>
@endif
						</div>
						<div class="form-group bg-blue-grey">
							<a href="#flow" role="tab" data-toggle="collapse" data-parent="#accordion" class="accordion-title">
							<h6 class="text-center">Alur</h6>
							</a>
						</div>
						<div id="flow" class="panel-collapse collapse" role="tabpanel">
							<div class="form-group">
							<div id="tree"></div>
							</div>
						</div>
@if (in_array($profile['user_level'], [1,3]))
						<div class="form-group bg-blue-grey">
							<a href="#log" role="tab" data-toggle="collapse" data-parent="#accordion" class="accordion-title">
							<h6 class="text-center">Log Aktifitas</h6>
							</a>
						</div>
						<div id="log" class="panel-collapse collapse" role="tabpanel">
							<div class="form-group">
								<ul class="list-unstyled">
@foreach ($data['memo_log'] as $row => $log)
								<li>{{ ($row + 1).". ".$log['log_user_post']." - ".$log['log_user_name']." ".$log['log_activity'] }} <small>({{ $log['log_date_text'] }})</small></li>
@endforeach
								</ul>
							</div>
						</div>
@endif
					</div>
				</div>
-->				
			</div>
@if (!empty($data['memo_content']))
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Tampilan Nota Dinas</h6>
					</div>				
					<div class="form-group">
						<div class="col-xs-12 well table-responsive">
							<div class="letter">
@include('pages/management/note_header')
@include('pages/management/note_view', $data)
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">&nbsp;</div>
					</div>
				</div>
			</div>
@endif
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
@if ($source <> "app" && !empty($data['memo_content']))
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
			url: "{{ url('outnote/fileview') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
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

	$('.download').click(function(){
		var	url = "{{ url('outnote/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});

	$('.peek').click(function(){
		$('#title').html('Relasi Surat');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['relation_id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('outnote/relationview') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});

	$('#print').click(function() {
		var url = "{{ url('outnote/print/'.$data['receiver_id']) }}";
		window.open(url);
	});

	var tree = $('#tree').jstree({
		'core': {
			'data': {
				"url": "{{ url('outnote/tree/'.$data['receiver_id']) }}",
				"dataType": "json"
			}
		}
	});
});
</script>
@endsection

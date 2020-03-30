@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ !empty($data['receiver_post_name']) ? $data['receiver_post_name'] : trans('site.data_detail') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['memo_id']) ? ['inmemo.update', $data['memo_id']] : ['inmemo.create', null], 'action'=>'InmemoController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('memo_id', null, ['id'=>'memo_id']) }}
			<div class="row">
				<div class="form-group bg-blue-grey">
					<h6 class="text-center">Data Memorandum</h6>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tanggal') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['memo_date_text'] }}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Hal') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['memo_title'] !!}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pengirim') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['memo_sender_name']." | ".$data['memo_sender_post_name'].(!empty($data['memo_sender_post_type']) ? " (".$data['memo_sender_post_type'].")" : "")." | ".$data['memo_sender_post_unit'] }}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Penerima') }}</div>
					<div class="col-sm-9 col-xs-8">
					<ul class="list-unstyled">
@foreach ($data['memo_receiver'] as $receiver)
						<li>{{ (sizeof($data['memo_receiver']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit'] }}</li>
@endforeach
					</ul>
					</div>
				</div>
<!--
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tembusan') }}</div>
					<div class="col-sm-9 col-xs-8">
					<ul class="list-unstyled">
@foreach ($data['memo_cc'] as $receiver)
						<li>{{ (sizeof($data['memo_cc']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit']  }}</li>
@endforeach
					</ul>
					</div>
				</div>
-->
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
					<div class="col-sm-3 col-xs-4">&nbsp;</div>
					<div class="col-sm-9 col-xs-8">
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
					<div class="col-sm-3 col-xs-4">{{ Form::label('Lokasi Fisik') }}</div>
					<div class="col-sm-9 col-xs-8">Tata Usaha
@foreach ($data['memo_receiver'] as $row => $receiver)
					{{ !empty($receiver['code']) ? ($row == 0 ? $receiver['code'] : ", ".$receiver['code']) : "" }}
@endforeach
@foreach ($data['memo_cc'] as $row => $cc)
					{{ !empty($cc['code']) ? ($row == 0 && sizeof($data['memo_receiver']) == 0 ? $cc['code'] : ", ".$cc['code']) : "" }}
@endforeach
					</div>
				</div>
-->
				<div class="form-group">
					<div class="col-xs-12">&nbsp;</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Tampilan Memorandum</h6>
					</div>
					<div class="form-group">
						<div class="col-xs-12 well table-responsive">
							<div class="letter letter-memo">
@include('pages/management/memo_header')
@include('pages/management/memo_view', $data)
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">&nbsp;</div>
					</div>
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
			url: "{{ url('inmemo/fileview') }}",
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
		var	url = "{{ url('inmemo/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});

	$('#print').click(function() {
		var url = "{{ url('inmemo/print/'.$data['receiver_id']) }}";
		window.open(url);
	});
});
</script>
@endsection

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
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['book_id']) ? ['bookoutbox.update', $data['book_id']] : ['bookoutbox.create', null], 'action'=>'BookOutboxController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('book_id', null, ['id'=>'book_id']) }}
			<div class="row">
				<div class="form-group bg-blue-grey">
					<h6 class="text-center">Data Pemesanan</h6>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tanggal') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['book_date_text'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Jenis Naskah') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['book_type'] !!}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Hal') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['book_content'] !!}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pengirim') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['book_sender_name']." | ".$data['book_sender_post_name']." | ".$data['book_sender_post_unit'] }}</div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pemohon') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['book_register_name'] }} <span class="pull-right"><small>{{ $data['book_register_date_text'] }}</small></span></div>
				</div>					
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Pemeriksa') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['book_verificator_name'] }} <span class="pull-right"><small>{{ $data['book_verificator_date_text'] }}</small></span></div>
				</div>
@if (!empty($data['book_verificator_note']))
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Nota Pemeriksa') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['book_verificator_note'] !!}</div>
				</div>
@endif				
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
			url: "{{ url('reportbook/fileview') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});			
	});	
	
	$('.download').click(function(){
		var	url = "{{ url('reportbook/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});	
});	
</script>
@endsection
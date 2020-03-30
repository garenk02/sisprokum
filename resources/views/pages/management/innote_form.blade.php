@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
@endsection

@section('content')
<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ !empty($data['receiver_post_name']) ? $data['receiver_post_name'] : trans('site.data_editor') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id'=>'form', 'route'=> !empty($data['receiver_id']) ? ['innote.update', $data['receiver_id']] : ['innote.create', null], 'action'=>'InnoteController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('memo_id', null, ['id'=>'memo_id']) }}
			{{ Form::hidden('receiver_id', null, ['id'=>'receiver_id']) }}
			<div class="row">
				<div class="col-sm-6 col-xs-12">	
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
						<div class="col-xs-8">{{ $data['memo_sender_post_code']." | ".$data['memo_sender_name'] }}</div>
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
						<li>{{ (sizeof($data['memo_receiver']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit']  }}</li>
@endforeach
						</ul>
						</div>
					</div>
					<div class="form-group form-line">
						<div class="col-xs-4">{{ Form::label('Tembusan') }}</div>
						<div class="col-xs-8">
						<ul class="list-unstyled">
@foreach ($data['memo_cc'] as $receiver)
						<li>{{ (sizeof($data['memo_cc']) > 1 ? "- " : "").$receiver['name']." | ".$receiver['post'].(!empty($receiver['post_type']) ? " (".$receiver['post_type'].")" : "")." | ".$receiver['unit']  }}</li>
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
				</div>
				<div class="col-sm-6 col-xs-12">
					<div id="accordion" class="accordion" role="tablist">
						<div class="form-group bg-blue-grey">
							<a href="#action" role="tab" data-toggle="collapse" data-parent="#accordion" class="accordion-title">
							<h6 class="text-center">Tindak Lanjut</h6>
							</a>
						</div>		
						<div id="action" class="panel-collapse collapse" role="tabpanel">
							<div class="form-group">
								<div class="col-xs-3">{{ Form::label('Tindak Lanjut') }}</div>
@if (!empty($profile['structure_disposition']))								
								<div class="col-xs-4">
								{{ Form::radio('action', 'disposition', false, ['class'=>'flat action']) }} Disposisi
								</div>
@endif
@if ($data['receiver_status'] != "done" && $data['memo_disposition_done'] == "yes")
								<div class="col-xs-5">						
								{{ Form::radio('action', 'done', false, ['class'=>'flat action']) }} Selesai
								</div>
@endif								
							</div>
							<div class="clearfix"></div>
							<fieldset id="disposition" style="display:none">
							{{ Form::hidden('disposition_origin', !empty($data['receiver_origin']) ? $data['receiver_origin'] : null, ['id'=>'disposition_origin']) }}
							{{ Form::hidden('disposition_parent', $data['receiver_user_id'], ['id'=>'disposition_parent']) }}
							{{ Form::hidden('disposition_parent_post', $data['receiver_post_id'], ['id'=>'disposition_parent_post']) }}
							{{ Form::hidden('group', $group) }} 
							<div class="form-group">
								<div class="col-xs-4">{{ Form::label('Tujuan') }}</div>
								<div class="col-xs-8">
								{{ Form::select('direction_user[]', $user_list, null, ['id'=>'disposition_user','class'=>'form-control select2_multiple', 'multiple'=>'multiple']) }}
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">{{ Form::label('Arahan') }}</div>
								<div class="col-xs-8">
								<ul class="list-unstyled">
@foreach ($master_options['action'] as $action)
@if (!empty($action))
								<li>{{ Form::checkbox('disposition_direction[]', $action, false, ['class'=>'flat direction']) }} {{ $action }}</li>
@endif
@endforeach
								</ul>
								</div>
							</div>
							</fieldset>
							<fieldset id="note" style="display:none">
							<div class="form-group">
								<div class="col-xs-12">{{ Form::label('Catatan') }}</div>							
								<div class="col-xs-12">
								{{ Form::bsEditor('disposition_note', '') }}
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 text-right">
								<img id="loading-action" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>
								<button type="button" id="submit-action" class="btn btn-success"><i class="fa fa-save"></i> {{ trans('site.submit') }}</button>
								</div>
							</div>
							</fieldset>
						</div>
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
			@if (in_array($disposition['disposition_parent_id'], $profile['user_posts']) && $data['receiver_status'] <> "done")
							<fieldset>
							{{ Form::hidden('revoke_id_'.$doner['disposition_group'], $doner['disposition_id']) }}
							{{ Form::hidden('revoke_group_'.$doner['disposition_group'], $doner['disposition_group']) }}
							{{ Form::hidden('revoke_user_'.$doner['disposition_group'], $profile['user_id']) }}							
							<div class="form-group revoke-note" style="display: none">
								<div class="col-xs-12">
								{{ Form::label('Alasan Anulir') }}
								</div>
								<div class="col-xs-12">
								{{ Form::text('revoke_note_'.$doner['disposition_group'], '', ['class'=>'form-control']) }}
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 text-right">
								<img id="loading-revoke_{{ $doner['disposition_group'] }}" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>
								<button type="button" class="btn btn-danger request-revoke"><i class="fa fa-ban"></i> {{ trans('site.revoke') }}</button>
								<button type="button" class="btn btn-success submit-revoke" title="{{ trans('site.data_revoke') }}" rel="{{ $doner['disposition_group'] }}" style="display: none"><i class="fa fa-save"></i> {{ trans('site.submit') }}</button>
								</div>
							</div>
							</fieldset>							
			@endif							
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
							<p>&nbsp;</p>						
		@if ($data['receiver_status'] != "done" && $disposition['disposition_status'] != "done" && isset($disposition['disposition_can_comment']) && (empty($disposition['disposition_comment']) || (!empty($disposition['disposition_comment']) && $disposition['disposition_comment'][sizeof($disposition['disposition_comment']) - 1]['comment_user_id'] != $profile['user_id'])))	
							<fieldset>
							{{ Form::hidden('comment_group_'.$disposition['disposition_group'], $disposition['disposition_group']) }}
							{{ Form::hidden('comment_user_'.$disposition['disposition_group'], $profile['user_id']) }}
							<div class="form-group">
								<div class="col-xs-12">
								{{ Form::label('Tanggapan') }}
								</div>
								<div class="col-xs-12">
								{{ Form::text('comment_note_'.$disposition['disposition_group'], '', ['class'=>'form-control']) }}
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 text-right">
								<img id="loading-comment_{{ $disposition['disposition_group'] }}" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>								
								<button type="button" class="btn btn-success submit-comment" rel="{{ $disposition['disposition_group'] }}"><i class="fa fa-save"></i> {{ trans('site.submit') }}</button>
								</div>
							</div>
							</fieldset>
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
	$('.view').click(function(){
		$('#title').html('Berkas Copy Digital');
		
		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['id'] = $(this).attr('rel');
		
		$.ajax({
			type: "POST",
			url: "{{ url('innote/fileview') }}",
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
		var	url = "{{ url('innote/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});	

	function submit_action()
	{
		var hasError = false;
		var data = new Object;
		data['_token'] = "{{ csrf_token() }}",
		data['action'] = $('input[name="action"]:checked').val();
		data['receiver_id'] = $('#receiver_id').val();
		data['disposition_origin'] = $('#disposition_origin').val();	
		data['disposition_parent'] = $('#disposition_parent').val();
		data['disposition_parent_post'] = $('#disposition_parent_post').val();
		data['disposition_user'] = $('#disposition_user').val();
		var direction = [];
		$('.direction:checkbox:checked').each(function() {
			direction.push($(this).val());
		});
		data['disposition_direction'] = direction;
		$('#disposition_note_area').val($('#disposition_note').html());		
		data['disposition_note'] = $('#disposition_note_area').val();
		
		if (data['disposition_direction'].length <= 0 && data['disposition_note'] == "") {
			hasError = true;
			$('#disposition_note').focus();				
			swal("Error!", "{{ trans('site.error_required') }}", "error");										
		}
		
		if (hasError == false)
		{
			$.ajax({
				type: "POST",
				url: "{{ url('innote/disposition') }}",
				dataType: "html",
				data: data,
				beforeSend: function() {
					$("#loading-action").show();
					$("#submit-action").hide();
				},					
				success: function(result){				
					if (result != "") {
						$('#accordion').html(result);						
						$('#accordion').iCheck({checkboxClass: 'icheckbox_flat-green', radioClass: 'iradio_flat-green'});
						
						activate();
					}	
				},
				complete: function() {
					$("#action").attr('class', 'panel-collapse collapse');
					$("#history").attr('class', 'panel-collapse collapse in');
				}					
			});	
		}
	}	

	function submit_comment(id)
	{
		var form = $(id).closest('fieldset');
		var group = $(id).attr('rel');		
		var data = new Object;
		data['_token'] = "{{ csrf_token() }}",
		data['comment_receiver'] = $('#receiver_id').val();
		data['comment_memo'] = $('#memo_id').val();
		data['comment_group'] = form.find('input[name="comment_group_' + group + '"]').val();
		data['comment_user'] = form.find('input[name="comment_user_' + group + '"]').val();
		data['comment_note'] = form.find('input[name="comment_note_' + group + '"]').val();
		
		$.ajax({
			type: "POST",
			url: "{{ url('innote/comment') }}",
			dataType: "html",
			data: data,
			beforeSend: function() {
				$("#loading-comment_" + group).show();
				$(id).hide();
			},					
			success: function(result){
				if (result != "") {
					$('#accordion').html(result);	
					$('#accordion').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});

					activate();
				}
			},
			complete: function() {				
				$("#history").attr('class', 'panel-collapse collapse in');
			}	
		});	
	}

	function request_revoke(id)
	{
		var form = $(id).closest('fieldset');
		form.find('.revoke-note').show();
		form.find('.request-revoke').hide();		
		form.find('.submit-revoke').show();		
		
		return false;
	}
	
	function submit_revoke(id)
	{
		var form = $(id).closest('fieldset');
		var group = $(id).attr('rel');
		var data = new Object;
		data['_token'] = "{{ csrf_token() }}",
		data['revoke_receiver'] = $('#receiver_id').val();
		data['revoke_memo'] = $('#memo_id').val();
		data['revoke_group'] = form.find('input[name="revoke_group_' + group + '"]').val();
		data['revoke_id'] = form.find('input[name="revoke_id_' + group + '"]').val();
		data['revoke_user'] = form.find('input[name="revoke_user_' + group + '"]').val();
		data['revoke_note'] = form.find('input[name="revoke_note_' + group + '"]').val();
		
		$.ajax({
			type: "POST",
			url: "{{ url('innote/revoke') }}",
			dataType: "html",
			data: data,
			beforeSend: function() {
				$("#loading-revoke_" + group).show();
				$(id).hide();
			},				
			success: function(result){
				if (result != "") {
					$('#accordion').html(result);	
					$('#accordion').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});

					activate();
				}					
			},
			complete: function() {			
				$("#history").attr('class', 'panel-collapse collapse in');
			}
		});	
	}	
	
	function activate()
	{				
		$('.action').on('ifChecked', function(event) {
			var action = $(this).val();
			if (action == "disposition") {
				$('#disposition').show();
				$("#disposition :input").attr("disabled", false);
			}
			else if (action == "done") {
				$('#disposition').hide();
				$("#disposition :input").attr("disabled", true);
			}
			$('#note').show();
		});					
		
		$('#submit-action').click(function() {
			submit_action();
		});	

		$('.submit-comment').click(function() {
			submit_comment(this);	
		});	
		
		$('.request-revoke').click(function() {
			request_revoke(this);
		});			
		
		$('.submit-revoke').click(function() {
			var id = $(this);			
			var title = $(this).attr('title');
			var message = "{{ trans('site.confirm_revoke') }}";
			swal({
				title: title, 
				text: message, 
				type: "warning",
				showCancelButton: true
			}, function() {
				submit_revoke(id);
			});		
		});			
	
		$('#disposition_note').wysiwyg({});
		autosize($('#disposition_note'));	
		
		$('#tree').jstree({
			'core': {
				'data': {
					"url": "{{ url('innote/tree/'.$data['receiver_id']) }}",
					"dataType": "json" 
				}
			}
		});			
		
		$(".select2_single").select2({
			placeholder: '- Pilih -',
			width: '100%',
			allowClear: true,		
		});
		
		$(".select2_group").select2({
			placeholder: '- Pilih -',
			width: '100%',
			allowClear: true,		
		});
		
		$(".select2_multiple").select2({
			placeholder: '- Pilih -',
			width: '100%',
			allowClear: true,		
			maximumSelectionLength: 0
		});		
	}
	
	activate();
	
	$('#print').click(function() {
		var url = "{{ url('innote/print/'.$data['receiver_id']) }}";
		window.open(url);
	});	
});	
</script>
@endsection

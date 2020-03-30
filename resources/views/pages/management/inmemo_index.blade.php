@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
<!-- Datatables -->
<link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ trans('site.data_list') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<div role="tabpanel">		  
@if (!empty(sizeof($profile['posts'])))
			<ul class="nav nav-tabs bar_tabs" role="tablist">
@foreach ($profile['posts'] as $row => $post)
				<li class="{{ $row == 0 ? 'active' : '' }}"><a href="#" role="tab" rel="{{ $post['post_id'] }}" class="list_tab" data-toggle="tab" aria-expanded="{{ $row == 0 ? 'true' : 'false' }}">{{ (!empty($post['post_type']) ? ucwords(strtolower($post['post_type'])).'. ' : '') . $post['post_code'] }} {!! !empty($post['count']) ? $post['count'] : '' !!} </a></li>
@endforeach
			</ul>
@endif
			</div>		  
			<div id="accordion" class="accordion" role="tablist">
				{{ Form::open() }}
				{{ Form::hidden('post', !empty($profile['post']['post_id']) ? $profile['post']['post_id'] : 0, ['id'=>'post']) }}				
				<div class="row form-group">
					<div class="col-sm-6 col-xs-12">
						<a href="#searchbox" role="tab" data-toggle="collapse" data-parent="#accordion" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('site.search_more') }}</a>
					</div>
					<div class="col-sm-6 col-xs-12 text-right">
@if (!empty($profile['user_modules'][30]))
						<a role="button" data-toggle="dropdown" aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="fa fa-inbox"></i> {{ trans('site.archive') }} <span class="caret"></span></a>
						<img id="loading-action" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>
						<ul class="dropdown-menu pull-right">
						<li><a role="menuitem" tabindex="-1" href="{{ url('archive') }}">Klasifikasi Baru</a></li>	
@if (!empty($archives))
@foreach ($archives as $archive)
						<li><a class="archive" role="menuitem" tabindex="-1" rel="{{ $archive['archive_id'] }}">{{ $archive['archive_name'] }}</a></li>	
@endforeach
@endif
						</ul>
@endif
					</div>
				</div>
				<div id="searchbox" class="panel-collapse collapse" role="tabpanel">
					<div class="row form-group">
						<div class="col-sm-4 col-xs-12">{{ Form::text('sender', null, ['id'=>'sender','class'=>'form-control','placeholder'=>'Nama Pengirim']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::text('sender_post', null, ['id'=>'sender_post','class'=>'form-control','placeholder'=>'Jabatan Pengirim']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::text('receiver', null, ['id'=>'receiver','class'=>'form-control','placeholder'=>'Kode Jabatan Penerima']) }}</div>						
					</div>
					<div class="row form-group">
						<div class="col-sm-3 col-xs-12">{{ Form::text('title', null, ['id'=>'title','class'=>'form-control','placeholder'=>'Hal']) }}</div>
						<div class="col-sm-3 col-xs-12">{{ Form::select('status', $status_options, !empty($status_selected) ? $status_selected : null, ['id'=>'status','class'=>'form-control','placeholder'=>'Pilih Status Surat']) }}</div>
						<div class="col-sm-3 col-xs-12">
							<div class="input-prepend input-group">
							{{ Form::text('date', null, ['id'=>'date','class'=>'form-control rangepicker','placeholder'=>'Tanggal Surat']) }}
							<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
							</div>
						</div>						
					</div>										
					<div class="row form-group">
						<div class="col-sm-4 col-sm-offset-8 col-xs-12">
						<div class="text-right">
							<button type="button" id="search" class="btn btn-success m-t-15 waves-effect"><i class="fa fa-search"></i> {{ trans('site.submit') }}</button>
							<button type="button" id="reset" class="btn btn-warning m-t-15 waves-effect"><i class="fa fa-eraser"></i> {{ trans('site.reset') }}</button>
							<button type="button" id="close" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-undo"></i> {{ trans('site.close') }}</button>
						</div>
						</div>
					</div>
				</div>
				{{ Form::close() }}
			</div>
			<div class="table-responsive">
			<table id="datatable" class="table table-striped table-bordered table-hover js-data dataTable dt-responsive nowrap">
			  <thead>
				<tr>
					<th width="15">#</th>
					<th width="15">&nbsp;</th>
					<th>Tanggal</th>
					<th>Hal</th>
					<th>Pengirim</th>
					<th>Penerima</th>
					<th width="45">&nbsp;</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
					<th>#</th>
					<th>&nbsp;</th>
					<th>Tanggal</th>
					<th>Hal</th>
					<th>Pengirim</th>
					<th>Penerima</th>
					<th>&nbsp;</th>
				</tr>
			  </tfoot>
			</table>
			</div>
		  </div>
		</div>
	</div>
  </div>
</div>
@endsection


@section('footer')
<!-- Datatables -->
<script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-scroller/js/datatables.scroller.min.js') }}"></script>
<script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>


<script language="javascript">
$(document).ready(function()
{
	$(".archive").click(function() {
		var data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['data_archive'] = $(this).attr('rel');
		data['data_type'] = "{{ $module['module_code'] }}";
		
		if ($('input[name="id[]"]:checked').length > 0) {
			var selected = [];
			$. each($('input[name="id[]"]:checked'), function(){
				selected.push($(this).val());
			});
			data['ids'] = selected;
			
			$.ajax({
				url: "{{ url('archive/insert') }}",
				type: "POST",
				data: data,	
				dataType: "text",			
				beforeSend: function(){
					$('#loading-action').show();
				},
				complete: function(){
					$('#loading-action').hide();				
				},
				success: function(data){
					swal("Success!", data, "success");
				},
				error: function(xhr, ajaxOptions, thrownError){
					swal("Error!", thrownError, "error");
				},
			});			
		}
		else {
			swal("Error!", "{{ trans('site.empty_checkbox') }}", "error");
		}
	
		return false;
	});	
	
    var oTable = $(".js-data").DataTable({
        "processing": true,
        "serverSide": true,
		"autoWidth": false,
        "ajax": {
            "url": "{{ url($module['module_code']) }}",
            "type": "POST",
			"data": function(data) {
				data._token = "{{ csrf_token() }}";
				data.sender = $('#sender').val();
				data.sender_post = $('#sender_post').val();
				data.post = $('#post').val();					
				data.title = $('#title').val();
				data.date = $('#date').val();
			},
        },
		"columnDefs": [{
			"targets": 1,
			"searchable": false,
			"orderable": false,
			"className": 'dt-body-center',
			"render": function (data, type, full, meta){
				return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
			}
		}],	
        "columns": [
            { "data": "row" },
			{ "data": "receiver_id" },
			{ "data": "memo_date" },
            { "data": "memo_title" },
			{ "data": "memo_sender_post_code" },
			{ "data": "memo_receiver" },
            { "data": "editor" }
        ],
		"oLanguage": {
			"oAria": {
				"sSortAscending": "{{ trans('site.sSortAscending') }}",
				"sSortDescending": "{{ trans('site.sSortDescending') }}"
			},
			"oPaginate": {
				"sFirst": "{{ trans('site.sFirst') }}",
				"sPrevious": "{{ trans('site.sPrevious') }}",
				"sNext": "{{ trans('site.sNext') }}",
				"sLast": "{{ trans('site.sLast') }}"
			},
			"sEmptyTable": "{{ trans('site.sEmptyTable') }}",
			"sInfo": "{{ trans('site.sInfo') }}",
			"sInfoEmpty": "{{ trans('site.sInfoEmpty') }}",
			"sInfoFiltered": "({{ trans('site.sInfoFiltered') }})",
			"sThousands": "{{ trans('site.sThousands') }}",
			"sLengthMenu": "{{ trans('site.sLengthMenu') }}",
			"sSearch": "{{ trans('site.sSearch') }}",
			"sZeroRecords": "{{ trans('site.sZeroRecords') }}"
		},
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        dom: "{{ in_array($profile['user_level'], [1,3]) ? 'Bflrtip' : 'flrtip' }}",
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		"initComplete": function(settings, json) {
			$('.confirmation').click(function(e) {
				e.preventDefault(); 
				var url = $(this).attr('href');
				var title = $(this).attr('title');
				var message = $(this).attr('rel');
				swal({
					title: title, 
					text: message, 
					type: "warning",
					showCancelButton: true
				}, function() {
					window.location.href = url;
				});
			});			
			
			$('[data-toggle="tooltip"]').tooltip();	
		}	
	});
	
	$('input').keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			oTable.ajax.reload();
		}
	});	
	
	$('.list_tab').click(function() {
		$('#post').val($(this).attr('rel'));
		oTable.ajax.reload();
	});	
	
	$('#search').click(function() {
		oTable.ajax.reload();
	});

	$('#reset').click(function() {
		$('#searchbox').find('input:text, input:password, select, textarea').val('');
		$('#searchbox').find('select').val('').trigger('change');
		$('#searchbox').find('input:radio, input:checkbox').prop('checked', false);
	});

	$('#close').click(function() {
		$('#searchbox').removeClass('in');
	});
});
</script>
@endsection

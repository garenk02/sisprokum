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
			<div class="form-group">
@if (in_array('create', $profile['user_modules'][$module['module_id']]) && (in_array($profile['user_level'], [1,3,5]) || ($profile['user_level'] == 6 && $profile['user_structure'] <= 2)))
				<a href="{{ url($module['module_code'].'/create') }}" class="btn btn-success"><i class="fa fa-edit"></i> {{ trans('site.data_new') }}</a>
@endif
			</div>
			<div class="table-responsive">
			<table id="datatable" class="table table-striped table-bordered table-hover js-data dataTable dt-responsive nowrap">
			  <thead>
				<tr>
					<th width="15">#</th>
					<th>Tanggal</th>
					<th>Penandatangan</th>
					<th>Jenis Surat</th>
					<th>Tujuan</th>
					<th>No. Surat</th>
					<th>Status</th>
					<th width="45">&nbsp;</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
					<th>#</th>
					<th>Tanggal</th>
					<th>Penandatangan</th>
					<th>Jenis Surat</th>
					<th>Tujuan</th>
					<th>No. Surat</th>
					<th>Status</th>
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
	$("#status").select2({
		placeholder: '- Pilih Status Pemesanan -',
		width: '100%',
		allowClear: true,		
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
			},			
        },
        "columns": [
            { "data": "row" },
			{ "data": "book_date" },
			{ "data": "book_sender_name" },
			{ "data": "book_type" },
			{ "data": "book_content" },
			{ "data": "book_agenda" },
			{ "data": "book_status" },
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
        dom: "{{ in_array($profile['user_level'], [1]) ? 'Bflrtip' : 'flrtip' }}",
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
		}	
	});
	
	$('input').keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			oTable.ajax.reload();
		}
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
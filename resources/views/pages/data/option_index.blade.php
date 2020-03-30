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
			<div class="form-group row">
				<div class="col-md-9 col-sm-6 col-xs-12">
@if (in_array('create', $profile['user_modules'][$module['module_id']]))				
				<a href="{{ url($module['module_code'].'/create') }}" class="btn btn-success"><i class="fa fa-edit"></i> {{ trans('site.data_new') }}</a>
@endif
				</div>	
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::open() }}
				{{ Form::select('type', $type_options, null, ['id'=>'type','class'=>'form-control']) }}
				{{ Form::close() }}				  
				</div>
			</div>	
			<p class="text-muted font-13 m-b-30">&nbsp;</p>
			<div class="table-responsive">
			<table id="datatable" class="table table-striped table-bordered table-hover js-data dataTable dt-responsive nowrap">
			  <thead>
				<tr>
					<th width="15">#</th>
					<th>Nama Pilihan</th>
					<th>Tipe Pilihan</th>
					<th>Urutan</th>
					<th width="45">&nbsp;</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
					<th>#</th>
					<th>Nama Pilihan</th>
					<th>Tipe Pilihan</th>
					<th>Urutan</th>
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
    var oTable = $(".js-data").DataTable({
        "processing": true,
        "serverSide": true,
		"autoWidth": false,
        "ajax": {
            "url": "{{ url($module['module_code']) }}",
            "type": "POST",
			"data": function(data) {
				data._token = "{{ csrf_token() }}";
				data.type = $('#type').val();
			},			
        },
        "columns": [
            { "data": "row" },
            { "data": "option_name" },
            { "data": "option_type" },
			{ "data": "option_order" },			
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
        dom: 'flrtip',
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
	
	$('#type').change(function() {
		oTable.ajax.reload();
	});		
	
});	
</script>
@endsection
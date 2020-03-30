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
			<div id="accordion" class="accordion" role="tablist">
				{{ Form::open() }}
				<div class="form-group">
@if (in_array($profile['user_level'], [1,3,6]) && in_array('create', $profile['user_modules'][$module['module_id']]))
					<a href="{{ url($module['module_code'].'/create') }}" class="btn btn-success"><i class="fa fa-edit"></i> {{ trans('site.data_new') }}</a>
@endif
					<a href="#searchbox" role="tab" data-toggle="collapse" data-parent="#accordion" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('site.search_more') }}</a>
				</div>
				<div id="searchbox" class="panel-collapse collapse" role="tabpanel">
					<div class="row form-group">
						<div class="col-sm-3 col-xs-12">{{ Form::text('agenda', null, ['id'=>'agenda','class'=>'form-control','placeholder'=>'Nomor Surat']) }}</div>
						<div class="col-sm-3 col-xs-12">{{ Form::text('sender', null, ['id'=>'sender','class'=>'form-control','placeholder'=>'Nama Pengirim']) }}</div>
						<div class="col-sm-3 col-xs-12">{{ Form::text('receiver', null, ['id'=>'receiver','class'=>'form-control','placeholder'=>'Penerima']) }}</div>
						<div class="col-sm-3 col-xs-12">{{ Form::text('cc', null, ['id'=>'cc','class'=>'form-control','placeholder'=>'Tembusan']) }}</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-4 col-xs-12">{{ Form::text('title', null, ['id'=>'title','class'=>'form-control','placeholder'=>'Hal']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::select('level', $master_options['urgency'], null, ['id'=>'level','class'=>'form-control','placeholder'=>'Pilih Sifat']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::select('status', $status_options, null, ['id'=>'status','class'=>'form-control','placeholder'=>'Pilih Status Surat']) }}</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-2 col-xs-12">{{ Form::text('agenda_number', null, ['id'=>'agenda_number','class'=>'form-control','placeholder'=>'Nomor Urut']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::select('agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control','placeholder'=>'Pilih Klasifikasi']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::select('agenda_unit', $post_internal_options, null, ['id'=>'agenda_unit','class'=>'form-control','placeholder'=>'Pilih Kode Unit']) }}</div>
						<div class="col-sm-2 col-xs-12">{{ Form::number('agenda_year', '', ['id'=>'agenda_year','class'=>'form-control','placeholder'=>'Tahun']) }}</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-3 col-xs-12">
							<div class="input-prepend input-group">
							{{ Form::text('date', null, ['id'=>'date','class'=>'form-control rangepicker','placeholder'=>'Tanggal Surat']) }}
							<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
							</div>
						</div>
@if (in_array($profile['user_level'], [1,3]))
						<div class="col-sm-3 col-xs-12">
							<div class="input-prepend input-group">
							{{ Form::text('retention_date', null, ['id'=>'retention_date','class'=>'form-control rangepicker','placeholder'=>'Tanggal Retensi']) }}
							<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-12">
						{{ Form::text('operator', null, ['id'=>'operator','class'=>'form-control','placeholder'=>'Nama Operator']) }}
						</div>
@endif
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
					<th>Nomor</th>
					<th>Tanggal</th>
					<th>Hal</th>
					<th>Pengirim</th>
					<th>Penerima</th>
					<th>Tembusan</th>
					<th width="45">&nbsp;</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
					<th>#</th>
					<th>Nomor</th>
					<th>Tanggal</th>
					<th>Hal</th>
					<th>Pengirim</th>
					<th>Penerima</th>
					<th>Tembusan</th>
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
	$("#level").select2({
		placeholder: '- Pilih Sifat Surat -',
		width: '100%',
		allowClear: true,
	});

	$("#status").select2({
		placeholder: '- Pilih Status Surat -',
		width: '100%',
		allowClear: true,
	});

	$("#agenda_class").select2({
		placeholder: '- Pilih Klasifikasi Masalah -',
		width: '100%',
		allowClear: true,
	});

	$("#agenda_unit").select2({
		placeholder: '- Pilih Kode Unit -',
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
				data.agenda_number = $('#agenda_number').val();
				data.agenda_class = $('#agenda_class').val();
				data.agenda_unit = $('#category').val() == "external" ? $('#agenda_unit_ex').val() : $('#agenda_unit_in').val();
				data.agenda_year = $('#agenda_year').val();
				data.agenda = $('#agenda').val();
				data.sender = $('#sender').val();
				data.receiver = $('#receiver').val();
				data.cc = $('#cc').val();
				data.title = $('#title').val();
				data.level = $('#level').val();
				data.status = $('#status').val();
				data.date = $('#date').val();
				data.retention_date = $('#retention_date').val();
				data.operator = $('#operator').val();
			},
        },
        "columns": [
            { "data": "row" },
            { "data": "memo_agenda" },
			{ "data": "memo_date" },
            { "data": "memo_title" },
			{ "data": "memo_sender_post_code" },
			{ "data": "memo_receiver" },
			{ "data": "memo_cc" },
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

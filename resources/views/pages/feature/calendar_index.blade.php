@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
<!-- FullCalendar -->
<link href="{{ asset('vendors/fullcalendar/3.9.0/fullcalendar.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/fullcalendar/3.9.0/fullcalendar.print.css') }}" rel="stylesheet" media="print">
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
@if (in_array('create', $profile['user_modules'][$module['module_id']]))				
					<a href="{{ url($module['module_code'].'/create') }}" class="btn btn-success"><i class="fa fa-edit"></i> {{ trans('site.data_new') }}</a>
@endif
					<a href="#searchbox" role="tab" data-toggle="collapse" data-parent="#accordion" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('site.search_more') }}</a>
				</div>
				<div id="searchbox" class="panel-collapse collapse" role="tabpanel">
					<div class="row form-group">
						<div class="col-sm-4 col-xs-12">{{ Form::select('owner', $post_list, null, ['id'=>'owner','class'=>'form-control select2_single','placeholder'=>'Pilih Pemilik Kegiatan']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::text('keyword', null, ['id'=>'keyword','class'=>'form-control','placeholder'=>'Nama Kegiatan atau Deskripsi']) }}</div>
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
			<div class="text-center">
				<img id="loading-calendar" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>
			</div>
			<div id='calendar'></div>
		  </div>
		</div>
	</div>
  </div>
</div>

<!-- calendar modal -->
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 class="modal-title" id="myModalLabel">Tambah Kegiatan</h4>
	  </div>
	  <div class="modal-body">
		<div id="testmodal" style="padding: 5px 20px;">
		  <form id="antoform" class="form-horizontal calender" role="form">
			<div class="form-group">
				<label class="control-label col-sm-3 col-xs-12">Pemilik Kegiatan</label>
				<div class="col-sm-9 col-xs-12">
				{{ Form::select('calendar_user', $post_options, null, ['id'=>'user','class'=>'form-control select2_single']) }}
				</div>
			</div>		  
			<div class="form-group">
			  <label class="control-label col-sm-3 col-xs-12">Nama Kegiatan</label>
			  <div class="col-sm-9 col-xs-12">
				{{ Form::text('calendar_title', null, ['id'=>'title','class'=>'form-control','required'=>true]) }}
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-3 col-xs-12">Deskripsi</label>
			  <div class="col-sm-9 col-xs-12">
				{{ Form::textarea('calendar_description', null, ['id'=>'description','class'=>'form-control']) }}
			  </div>
			</div>
			<fieldset id="share">
			<div class="form-group">
				<label class="control-label col-sm-3 col-xs-12">Berbagi Kepada</label>
				<div class="col-sm-9 col-xs-12">
				{{ Form::select('calendar_share', $post_list, [], ['id'=>'shares','multiple'=>true,'class'=>'form-control select2_multiple']) }}
				</div>
			</div>				
			</fieldset>
			<div class="form-group">
				<label class="control-label col-sm-3 col-xs-12">Publikasi Kegiatan</label>
				<div class="col-sm-9 col-xs-12">
					<div><label>
					{{ Form::checkbox('calendar_public', 'yes', false, ['id'=>'publication','class'=>'js-switch']) }} Tersedia untuk Publik
					</label></div>
				</div>
			</div>
		  </form>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" id="save" class="btn btn-success m-t-15 waves-effect antosubmit"><i class="fa fa-save"></i> {{ trans('site.save') }}</button>
		<button type="button" class="btn btn-primary antoclose" data-dismiss="modal"><i class="fa fa-undo"></i> {{ trans('site.cancel') }}</button>
	  </div>
	</div>
  </div>
</div>

<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
<!-- /calendar modal -->
@endsection


@section('footer')
<!-- FullCalendar -->
<script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/fullcalendar/3.9.0/fullcalendar.min.js') }}"></script>


<script language="javascript">
$(window).load(function() {
	var date = new Date(),
		d = date.getDate(),
		m = date.getMonth(),
		y = date.getFullYear(),
		started,
		categoryClass;

	var calendar = $('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listWeek'
		},
		selectable: true,
		selectHelper: true,
		select: function(start, end, allDay) {
			$('#fc_create').click();
			started = start;
			ended = end;		
			
			$(".antosubmit").on("click", function() {				
				var title = $("#title").val();				
				if (end) {
					ended = end;
				}
				categoryClass = $("#event_type").val();			
				if (title) {
					calendar.fullCalendar('renderEvent', {
							title: title,
							start: started,
							end: end,
							allDay: allDay
						},
						true 
					);
				}

				var data = new Object;
				data['_token'] = "{{ csrf_token() }}";
				data['calendar_user'] = $('#user').val();
				data['calendar_title'] = $('#title').val();
				data['calendar_description'] = $('#description').val();
				data['calendar_public'] = $('#publication').val();
				data['calendar_share'] = $('#shares').select2('val');
				data['calendar_start'] = moment(start).format('Y-MM-DD HH:mm:ss');
				data['calendar_end'] = moment(end).format('Y-MM-DD HH:mm:ss');
				
				$.ajax({
					url: "{{ url($module['module_code'].'/insert') }}",
					type: "POST",
					dataType: "json",
					data: data,
					success: function(doc) {

					}
				});					
				
				$('#title').val('');
				calendar.fullCalendar('unselect');
				$('.antoclose').click();

				return false;
			});
		},
		eventClick: function(calEvent, jsEvent, view) {
/*			console.log(calEvent.toSource());
			console.log(jsEvent.toSource());
			console.log(view.toSource());
			$('#fc_edit').click();
			$('#title2').val(calEvent.title);

			categoryClass = $("#event_type").val();

			$(".antosubmit2").on("click", function() {
				calEvent.title = $("#title2").val();

				calendar.fullCalendar('updateEvent', calEvent);
				$('.antoclose2').click();
			});

			calendar.fullCalendar('unselect');
*/		},
		editable: true,
		events: {
			url: "{{ url($module['module_code']) }}",
			type: "POST",
			data: {
				_token: "{{ csrf_token() }}",
				user: $('#owner').val()
			},
			color: '#26B99A',  
			textColor: '#ffffff' 
		},
		loading: function(bool) {
			$('#loading-calendar').toggle(bool);
		}
	});
	
	$('#search').click(function() {
		var events = {
			url: "{{ url($module['module_code']) }}",
			type: "POST",
			data: {
				_token: "{{ csrf_token() }}",
				user: $('#owner').val()
			},
			error: function() {
				alert('there was an error while fetching events!');
			},
			color: '#26B99A',  
			textColor: '#ffffff' 
		}

		$('#calendar').fullCalendar('removeEventSource', events);
		$('#calendar').fullCalendar('addEventSource', events);		
	});
	
	$('#reset').click(function() {
		$('#searchbox').find('input:text, input:password, select, textarea').val('');
		$('#searchbox').find('select').val('').trigger('change');		
		$('#searchbox').find('input:radio, input:checkbox').prop('checked', false);
	});

	$('#close').click(function() {
		$('#searchbox').removeClass('in');
	});
	
	$('#description').wysiwyg({});
	autosize($('#description'));
	
	$('#publication').change(function() {
		if ($(this).is(":checked")) {
			$('#share').hide();
		}
		else {
			$('#share').show();
		}
	});	
});
</script>
@endsection
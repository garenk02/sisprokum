@extends('layouts.app')

@section('title', $module['module_name'])

@section('header')
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
@if (in_array($profile['user_level'], [1,4]) && in_array('create', $profile['user_modules'][$module['module_id']]))				
					<a href="{{ url($module['module_code'].'/create') }}" class="btn btn-success"><i class="fa fa-edit"></i> {{ trans('site.data_new') }}</a>
@endif
					<a href="#searchbox" role="tab" data-toggle="collapse" data-parent="#accordion" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('site.search_more') }}</a>
				</div>
				<div id="searchbox" class="panel-collapse collapse" role="tabpanel">
					<div class="row form-group">
						<div class="col-sm-2 col-xs-12">{{ Form::text('agenda', null, ['id'=>'agenda','class'=>'form-control','placeholder'=>'Nomor Agenda']) }}</div>
						<div class="col-sm-2 col-xs-12">{{ Form::text('inbox', null, ['id'=>'inbox','class'=>'form-control','placeholder'=>'Nomor Surat']) }}</div>
						<div class="col-sm-2 col-xs-12">{{ Form::text('sender', null, ['id'=>'sender','class'=>'form-control','placeholder'=>'Nama Pengirim']) }}</div>
						<div class="col-sm-2 col-xs-12">{{ Form::text('receiver', null, ['id'=>'receiver','class'=>'form-control','placeholder'=>'Kode Jabatan Penerima']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::text('content', null, ['id'=>'content','class'=>'form-control','placeholder'=>'Hal']) }}</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-3 col-xs-12">{{ Form::select('category', $category_options, null, ['id'=>'category','class'=>'form-control','placeholder'=>'Pilih Kategori Surat']) }}</div>
						<div class="col-sm-3 col-xs-12">{{ Form::select('class', $master_options['class'], null, ['id'=>'class','class'=>'form-control','placeholder'=>'Pilih Sifat Surat']) }}</div>
						<div class="col-sm-3 col-xs-12">{{ Form::select('level', $master_options['urgency'], null, ['id'=>'level','class'=>'form-control','placeholder'=>'Pilih Tingkat Urgensi']) }}</div>
						<div class="col-sm-3 col-xs-12">{{ Form::select('status', $status_options, null, ['id'=>'status','class'=>'form-control','placeholder'=>'Pilih Status Surat']) }}</div>
					</div>					
					<div class="row form-group">
						<div class="col-sm-2 col-xs-12">{{ Form::text('agenda_number', null, ['id'=>'agenda_number','class'=>'form-control','placeholder'=>'Nomor Urut Agenda']) }}</div>
						<div class="col-sm-4 col-xs-12">{{ Form::select('agenda_class', $class_options, null, ['id'=>'agenda_class','class'=>'form-control','placeholder'=>'Pilih Klasifikasi']) }}</div>
						<div class="col-sm-4 col-xs-12">
						<fieldset id="unitInternal">
						{{ Form::select('agenda_unit', $unit_internal_options, null, ['id'=>'agenda_unit_in','class'=>'form-control','placeholder'=>'Pilih Kode Unit']) }}
						</fieldset>
						<fieldset id="unitExternal" style="display: none">
						{{ Form::select('agenda_unit', $unit_external_options, null, ['id'=>'agenda_unit_ex','class'=>'form-control','placeholder'=>'Pilih Kode Unit']) }}
						</fieldset>
						</div>
						<div class="col-sm-2 col-xs-12">{{ Form::number('agenda_year', '', ['id'=>'agenda_year','class'=>'form-control','placeholder'=>'Tahun Agenda']) }}</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-3 col-xs-12">
							<div class="input-prepend input-group">					
							{{ Form::text('date', null, ['id'=>'date','class'=>'form-control rangepicker','placeholder'=>'Tanggal Surat']) }}
							<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>						
							</div>
						</div>
						<div class="col-sm-3 col-xs-12">
							<div class="input-prepend input-group">					
							{{ Form::text('agenda_date', null, ['id'=>'agenda_date','class'=>'form-control rangepicker','placeholder'=>'Tanggal Agenda']) }}
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
			<!--- Start of Content --->
			<div id="mail-list">
			<input type="hidden" class="page">
			<input type="hidden" class="pagetotal">			
			</div>
			<p class="text-center">
			<img id="loading-image" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>
			</p>
			<p class="text-center">
			<button type="button" id="load" class="btn btn-success m-t-15 waves-effect"><i class="fa fa-envelope-o"></i> {{ trans('pagination.next') }}</button>
			</p>
			<!--- End of Content --->	
		  </div>
		</div>
	</div>
  </div>
</div>
@endsection


@section('footer')
<script language="javascript">
$(document).ready(function() 
{
	$("#category").select2({
		placeholder: '- Pilih Kategori Surat -',
		width: '100%',
		allowClear: true,		
	}).on("change", function(e) {
		if ($('#category').select2('val') == "external") {
			$('#unitInternal').hide();
			$('#unitExternal').show();			
		}
		else {
			$('#unitInternal').show();
			$('#unitExternal').hide();						
		}
	});
	
	$("#class").select2({
		placeholder: '- Pilih Sifat Surat -',
		width: '100%',
		allowClear: true,		
	});	
	
	$("#level").select2({
		placeholder: '- Pilih Tingkat Urgensi -',
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
	
	$("#agenda_unit_in").select2({
		placeholder: '- Pilih Kode Unit -',
		width: '100%',
		allowClear: true,		
	});		
	
	$("#agenda_unit_ex").select2({
		placeholder: '- Pilih Kode Unit -',
		width: '100%',
		allowClear: true,		
	});			
	
	$('input').keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			search(1);
		}
	});	
	
	$('#search').click(function() {
		$("#mail-list").empty();
		search(1);
	});
	
	$('#reset').click(function() {
		$('#searchbox').find('input:text, input:password, select, textarea').val('');
		$('#searchbox').find('select').val('').trigger('change');		
		$('#searchbox').find('input:radio, input:checkbox').prop('checked', false);
	});
	
	$('#close').click(function() {
		$('#searchbox').removeClass('in');
	});	
	
	function search(page) {
		var data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['page'] = page;
		data['agenda_number'] = $('#agenda_number').val();
		data['agenda_class'] = $('#agenda_class').val();
		data['agenda_unit'] = $('#category').val() == "external" ? $('#agenda_unit_ex').val() : $('#agenda_unit_in').val();
		data['agenda_year'] = $('#agenda_year').val();	
		data['agenda'] = $('#agenda').val();
		data['inbox'] = $('#inbox').val();	
		data['sender'] = $('#sender').val();
		data['receiver'] = $('#receiver').val();
		data['content'] = $('#content').val();	
		data['category'] = $('#category').val();	
		data['class'] = $('#class').val();
		data['level'] = $('#level').val();
		data['status'] = $('#status').val();
		data['date'] = $('#date').val();
		data['agenda_date'] = $('#agenda_date').val();		
		data['retention_date'] = $('#retention_date').val();
		data['operator'] = $('#operator').val();		
		
		$.ajax({
            url: "{{ url($module['module_code']) }}",
            type: "POST",
			data: data,	
			dataType: "text",			
			beforeSend: function(){
				$('#loading-image').show();
			},
			complete: function(){
				$('#loading-image').hide();
				
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
			},
			success: function(data){
				$("#mail-list").append(data);
			},
			error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
			},
		});
	}	
	
	$('#load').click(function(){
		var page = parseInt($(".page:last").val());
		var total = parseInt($(".pagetotal:last").val());
		if (page < total) {
			page = page + 1;
			search(page);
		}
	});

	$(window).scroll(function(){
		if ($(window).scrollTop() == $(document).height() - $(window).height()){
			var page = parseInt($(".page:last").val());
			var total = parseInt($(".pagetotal:last").val());
			if (page < total) {
				page = page + 1;
				search(page);
			}
		}
	});

	
	search(1);	
});	
</script>
@endsection
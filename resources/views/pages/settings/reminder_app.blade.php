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
			<div class="form-group">
@if (in_array('create', $profile['user_modules'][$module['module_id']]))
				<a href="{{ url($module['module_code'].'/create') }}" class="btn btn-success"><i class="fa fa-edit"></i> {{ trans('site.data_new') }}</a>
@endif
			</div>
			<p class="text-muted font-13 m-b-30">&nbsp;</p>
			<!--- Start of Content --->
			<div id="mail-list">
			<input type="hidden" class="page">
			<input type="hidden" class="pagetotal">			
			</div>
			<img id="loading-action" src="{{ asset('images/logo/loading.gif') }}" style="display: none;"/>
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
	function search(page) {
		var data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['page'] = page;
		
		$.ajax({
            url: "{{ url($module['module_code']) }}",
            type: "POST",
			data: data,	
			dataType: "text",			
			beforeSend: function(){
				$('#loading-action').show();
			},
			complete: function(){
				$('#loading-action').hide();
				
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

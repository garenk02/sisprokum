@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		{{ Form::open() }}
		  <div class="x_content">
			<!--- Start of Content --->
			<div id="mail-list">
			<input type="hidden" class="page">
			<input type="hidden" class="pagetotal">			
			</div>
			<img id="loading-action" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>
			<!--- End of Content --->	
		  </div>
		{{ Form::close() }}
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
            url: "{{ url('notification') }}",
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
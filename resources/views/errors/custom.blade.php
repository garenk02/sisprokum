@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('header')
@endsection

@section('content')
<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $exception->getMessage() }}</small></h2>
			<ul class="nav navbar-right panel_toolbox">
			  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			</ul>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<div class="well">{{ $exception->getMessage() }}</div>
		  </div>
		</div>
	</div>
</div>
@endsection


@section('footer')
<script language="javascript">
$(document).ready(function() {

});	
</script>
@endsection
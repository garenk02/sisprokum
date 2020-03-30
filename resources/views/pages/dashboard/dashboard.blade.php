@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', 'Sistem Informasi Persuratan Dinas')

@section('header')
@endsection

@section('content')
<!-- top tiles -->
<div class="row tile_count">
<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
  <span class="count_top"><i class="fa fa-envelope"></i> Total Surat</span>
  <a href="{{ url('inbox') }}">
  <div class="count green">{{ $count['total'] }}</div>
  </a>
</div>
<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
  <span class="count_top"><i class="fa fa-envelope-o"></i> Dibaca</span>
  <a href="{{ url('inbox/index/status-read') }}">  
  <div class="count">{{ $count['read'] }}</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
  <span class="count_top"><i class="fa fa-envelope"></i> Belum Dibaca</span>
  <a href="{{ url('inbox/index/status-unread') }}">    
  <div class="count">{{ $count['unread'] }}</div>
  </a>
</div>
<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
  <span class="count_top"><i class="fa fa-group"></i> Disposisi</span>
  <a href="{{ url('inbox/index/status-disposition') }}">   
  <div class="count">{{ $count['disposition'] }}</div>
  </a>
</div>
<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
  <span class="count_top"><i class="fa fa-check-square-o"></i> Selesai</span>
  <a href="{{ url('inbox/index/status-done') }}">   
  <div class="count">{{ $count['done'] }}</div>
  </a>
</div>
<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
  <span class="count_top"><i class="fa fa-ban"></i> Tunda</span>
  <a href="{{ url('inbox/index/status-pending') }}">   
  <div class="count">{{ $count['pending'] }}</div>
  </a>
</div>
</div>
<!-- /top tiles -->

<div class="row">
<div class="col-md-4 col-sm-4 col-xs-12">
  <div class="x_panel tile fixed_height_320">
	<div class="x_title">
	  <h2>Amat Segera</h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		</ul>		  
	  <div class="clearfix"></div>
	</div>
	<div class="x_content">
	<ul class="to_do">
	<a href="{{ url('inbox/index/class-Sangat Rahasia+level-Amat Segera') }}"><li>Sangat Rahasia <span class="pull-right">[{{ !empty($urgency['as_sr_total']) ? $urgency['as_sr_read']." / ".$urgency['as_sr_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Rahasia+level-Amat Segera') }}"><li>Rahasia <span class="pull-right">[{{ !empty($urgency['as_r_total']) ? $urgency['as_r_read']." / ".$urgency['as_r_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Umum+level-Amat Segera') }}"><li>Umum <span class="pull-right">[{{ !empty($urgency['as_u_total']) ? $urgency['as_u_read']." / ".$urgency['as_u_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Terbatas+level-Amat Segera') }}"><li>Terbatas <span class="pull-right">[{{ !empty($urgency['as_t_total']) ? $urgency['as_t_read']." / ".$urgency['as_t_total'] : "0 / 0" }}]</span></li></a>
	</ul>
	</div>
  </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
  <div class="x_panel tile fixed_height_320 overflow_hidden">
	<div class="x_title">
	  <h2>Segera</h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		</ul>		  
	  <div class="clearfix"></div>
	</div>
	<div class="x_content">
	<ul class="to_do">
	<a href="{{ url('inbox/index/class-Sangat Rahasia+level-Segera') }}"><li>Sangat Rahasia <span class="pull-right">[{{ !empty($urgency['s_sr_total']) ? $urgency['s_sr_read']." / ".$urgency['s_sr_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Rahasia+level-Segera') }}"><li>Rahasia <span class="pull-right">[{{ !empty($urgency['s_r_total']) ? $urgency['s_r_read']." / ".$urgency['s_r_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Umum+level-Segera') }}"><li>Umum <span class="pull-right">[{{ !empty($urgency['s_u_total']) ? $urgency['s_u_read']." / ".$urgency['s_u_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Terbatas+level-Segera') }}"><li>Terbatas <span class="pull-right">[{{ !empty($urgency['s_t_total']) ? $urgency['s_t_read']." / ".$urgency['s_t_total'] : "0 / 0" }}]</span></li></a>
	</ul>
	</div>
  </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
  <div class="x_panel tile fixed_height_320">
	<div class="x_title">
	  <h2>Biasa</h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		</ul>		  
	  <div class="clearfix"></div>
	</div>
	<div class="x_content">
	<ul class="to_do">
	<a href="{{ url('inbox/index/class-Sangat Rahasia+level-Biasa') }}"><li>Sangat Rahasia <span class="pull-right">[{{ !empty($urgency['b_sr_total']) ? $urgency['b_sr_read']." / ".$urgency['b_sr_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Rahasia+level-Biasa') }}"><li>Rahasia <span class="pull-right">[{{ !empty($urgency['b_r_total']) ? $urgency['b_r_read']." / ".$urgency['b_r_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Umum+level-Biasa') }}"><li>Umum <span class="pull-right">[{{ !empty($urgency['b_u_total']) ? $urgency['b_u_read']." / ".$urgency['b_u_total'] : "0 / 0" }}]</span></li></a>
	<a href="{{ url('inbox/index/class-Terbatas+level-Biasa') }}"><li>Terbatas <span class="pull-right">[{{ !empty($urgency['b_t_total']) ? $urgency['b_t_read']." / ".$urgency['b_t_total'] : "0 / 0" }}]</span></li></a>
	</ul>
	</div>
  </div>
</div>
</div>

<div class="row">
<div class="col-xs-12">
  <div class="x_panel">
	<div class="x_title">
	  <h2>Informasi Sistem <small>Informasi Teraktual SIPENAS</small></h2>
	  <ul class="nav navbar-right panel_toolbox">
		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
	  </ul>
	  <div class="clearfix"></div>
	</div>
	<div class="x_content">
	  <div class="dashboard-widget-content">
		<ul class="list-unstyled timeline widget">
@foreach ($infos as $info)
		  <li>
			<div class="block">
			  <div class="block_content">
				<h2 class="title">{{ $info['information_title'] }}</h2>
				<div class="byline"><span>{{ $info['information_date'] }}</span> oleh: <a>{{ $info['information_name'] }}</a></div>
				<p class="excerpt">{!! $info['information_note'] !!}</p>
@if (!empty($info['information_file']))
				<p class="excerpt"><a href="{{ $info['information_file'] }}" target="_blank" class="btn btn-xs btn-success"><i class="fa fa-download"></i> Unduh Dokumen</a></p>
@endif
			  </div>
			</div>
		  </li>
@endforeach
		</ul>
	  </div>
	</div>
  </div>
</div>
</div>
@endsection
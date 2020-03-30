@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
@endsection

@section('content')
<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ trans('site.data_detail') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['calendar_id']) ? ['calendar.update', $data['calendar_id']] : ['calendar.create', null], 'action'=>'CalendarController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('calendar_id', null, ['id'=>'calendar_id']) }}
			<div class="row">
				<div class="form-group bg-blue-grey">
					<h6 class="text-center">Data Kegiatan</h6>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Nama Kegiatan') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['calendar_title'] }}</div>
				</div>	
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Deskripsi') }}</div>
					<div class="col-sm-9 col-xs-8">{!! $data['calendar_description'] !!}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tanggal/Waktu Mulai') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['calendar_start_text'] }}</div>
				</div>
				<div class="form-group form-line">
					<div class="col-sm-3 col-xs-4">{{ Form::label('Tanggal/Waktu Akhir') }}</div>
					<div class="col-sm-9 col-xs-8">{{ $data['calendar_end_text'] }}</div>
				</div>							
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
@if (!empty($profile['user_modules'][$module['module_id']]) && in_array('update', $profile['user_modules'][$module['module_id']]))
					<button type="button" id="edit" class="btn btn-warning m-t-15 waves-effect"><i class="fa fa-edit"></i> {{ trans('site.update') }}</button>
@endif
					<button type="button" id="back" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-undo"></i> {{ trans('site.back') }}</button>
				</div>
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

});	
</script>
@endsection
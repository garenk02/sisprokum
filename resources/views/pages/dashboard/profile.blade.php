@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', 'Data Pengguna')

@section('header')
@endsection

@section('content')
<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Data Pengguna</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id' => 'form', 'route' => ['profile.update', $data['user_id']], 'action' => 'HomeController@save', 'class'=>'form-horizontal form-label-left', 'files'=>true]) }}
			<div class="row">
				<div class="col-sm-3 col-xs-12">
					<div class="col-xs-12">
					<img src="{{ asset('images/users/'. (!empty($data['user_photo']) ? $data['user_photo'] : 'no-image.jpg')) }}" class="thumbnail">
					</div>
				</div>
				<div class="col-sm-9 col-xs-12">			
					<ul id="profileTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class="active"><a href="#tab_1" id="profile-tab" role="tab" data-toggle="tab" aria-expanded="true" class="tab">{{ trans('site.profile') }}</a></li>
						<li role="presentation" class=""><a href="#tab_2" role="tab" id="history-tab" data-toggle="tab" aria-expanded="false" class="tab">{{ trans('site.post_history') }}</a></li>						
					</ul>			
					<div id="profileTabContent" class="tab-content">
						<div id="tab_1" class="tab-pane fade active in" aria-labelledby="profile-tab" role="tabpanel">
							<fieldset id="profile-data">
							<div class="form-group form-line">
								<div class="col-xs-3">{{ Form::label(trans('site.name')) }}</div>
								<div class="col-xs-9">{{ $data['user_name'] }}</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-3">{{ Form::label(trans('site.pin')) }}</div>
								<div class="col-xs-9">{{ $data['user_pin'] }}</div>
							</div>	
							<div class="form-group form-line">
								<div class="col-xs-3">{{ Form::label(trans('site.email')) }}</div>
								<div class="col-xs-9">{{ $data['user_email'] }}</div>
							</div>													
							<div class="form-group form-line">
								<div class="col-xs-3">{{ Form::label('Jabatan') }}</div>
								<div class="col-xs-9">{{ $data['post_name'] }}</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-3">{{ Form::label('Unit Jabatan') }}</div>
								<div class="col-xs-9">{{ $data['post_unit'] }}</div>
							</div>	
							<div class="form-group">
								<div class="col-xs-3">{{ Form::label('Struktural') }}</div>
								<div class="col-xs-9">{{ $data['structure_name'] }}</div>
							</div>	
							</fieldset>
							<fieldset id="profile-edit" style="display: none">
							<div class="form-group form-line">
								<div class="col-sm-3 col-xs-3">{{ Form::label(trans('site.name')) }} <span style="color:red">*</span></div>
								<div class="col-sm-6 col-xs-9">
									<div class="form-group">
									{{ Form::text('user_name', $data['user_name'], ['class'=>'form-control','required'=>true]) }}
									</div>						
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-sm-3 col-xs-3">{{ Form::label(trans('site.email')) }}</div>
								<div class="col-sm-6 col-xs-9">
									<div class="input-prepend input-group">
									{{ Form::text('user_email', $data['user_email'], ['class'=>'form-control']) }}
									<span class="add-on input-group-addon"><i class="glyphicon glyphicon-envelope fa fa-envelope"></i></span>
									</div>						
								</div>
							</div>		
							<div class="form-group form-line">
								<div class="col-sm-3 col-xs-3">{{ Form::label(trans('site.photo')) }}</div>
								<div class="col-sm-6 col-xs-9">
								{{ Form::file('photo', ['class'=>'form-control']) }}
								</div>
							</div>									
							<div class="form-group form-line">
								<div class="col-sm-3 col-xs-3">{{ Form::label(trans('site.oldpassword')) }}</div>
								<div class="col-sm-4 col-xs-9">
									<div class="input-prepend input-group">
									{{ Form::password('oldpassword', ['class'=>'form-control']) }}
									<span class="add-on input-group-addon"><i class="glyphicon glyphicon-lock fa fa-lock"></i></span>
									</div>						
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-sm-3 col-xs-3">{{ Form::label(trans('site.password')) }}</div>
								<div class="col-sm-4 col-xs-9">
									<div class="input-prepend input-group">
									{{ Form::password('password', ['class'=>'form-control']) }}
									<span class="add-on input-group-addon"><i class="glyphicon glyphicon-lock fa fa-lock"></i></span>
									</div>						
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3 col-xs-3">{{ Form::label(trans('site.repassword')) }}</div>
								<div class="col-sm-4 col-xs-9">
									<div class="input-prepend input-group">						
									{{ Form::password('password_confirmation', ['class'=>'form-control']) }}
									<span class="add-on input-group-addon"><i class="glyphicon glyphicon-lock fa fa-lock"></i></span>
									</div>						
								</div>
							</div>
							</fieldset>
						</div>
						<div id="tab_2" class="tab-pane fade" aria-labelledby="history-tab" role="tabpanel">					
							<div class="form-group">
							<table class="table table-stripped table-hovered">
							<tr>
								<th width="10">#</th>
								<th>Jabatan</th>
								<th>Rentang Tanggal</th>
							</tr>
@if (!empty($history))
@foreach ($history as $row => $post)
							<tr>
								<td>{{ $row + 1 }}.</td>
								<td>{{ $post['pos_post_name'] }}</td>
								<td>{{ $post['pos_start_text'] .' ~ '. $post['pos_end_text'] }}</td>
							</tr>
@endforeach
@else
							<tr>
								<td colspan="3" style="text-align: center">- Tidak ada riwayat jabatan pelaksana -</td>
							</tr>
@endif
							</table>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
					<button type="button" id="modify" class="btn btn-success m-t-15 waves-effect"><i class="fa fa-edit"></i> {{ trans('site.data_update') }}</button>
					<button type="submit" id="save" class="btn btn-success m-t-15 waves-effect" style="display: none"><i class="fa fa-save"></i> {{ trans('site.save') }}</button>
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
	$('.tab').click(function(e) {
		$('#profile-data').show();
		$('#profile-edit').hide();
		$('#modify').show();
		$('#save').hide();
	});
	
	$('#modify').click(function(e){
		e.preventDefault();
		$('#profileTab a[href="#tab_1"]').tab('show');
		$('#profile-data').hide();
		$('#profile-edit').show();		
		$('#modify').hide();
		$('#save').show();
	})
});	
</script>
@endsection
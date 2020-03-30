@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
@endsection

@section('content')
<div class="row">	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ trans('site.data_editor') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['ireceiver.update', $data['receiver_id']] : ['ireceiver.create', null], 'action'=>'InboxReceiverController@save', 'class'=>'form-horizontal form-label-left']) }}
			{{ Form::hidden('receiver_id', null) }}
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Inbox ID <span style="color:red">*</span></label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::text('receiver_inbox', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Origin ID <span style="color:red">*</span></label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::text('receiver_origin', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penerima <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('receiver_user_id', $user_list, null, ['id'=>'user_id','class'=>'form-control select2_single','required'=>true]) }}
				{{ Form::hidden('receiver_user_name', null, ['id'=>'user_name']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Jabatan Penerima <span style="color:red">*</span></label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('receiver_post_id', $post_list, null, ['id'=>'post_id','class'=>'form-control select2_single','required'=>true]) }}
				{{ Form::hidden('receiver_post_code', null, ['id'=>'post_code']) }}
				{{ Form::hidden('receiver_post_name', null, ['id'=>'post_name']) }}
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Parent Inbox ID</label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::text('receiver_parent_inbox', null, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penerima Sebelumnya</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('receiver_parent_id', $user_list, null, ['id'=>'parent_id','class'=>'form-control select2_single']) }}
				{{ Form::hidden('receiver_parent_name', null, ['id'=>'parent_name']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Jabatan Sebelumnya</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('receiver_parent_post_id', $post_list, null, ['id'=>'parent_post_id','class'=>'form-control select2_single']) }}
				{{ Form::hidden('receiver_parent_post_code', null, ['id'=>'parent_post_code']) }}
				{{ Form::hidden('receiver_parent_post_name', null, ['id'=>'parent_post_name']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Group ID</label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::text('receiver_group', null, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Surat <span style="color:red">*</span></label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::bsDatetime('receiver_date', !empty($data['receiver_date']) ? $data['receiver_date'] : "", ['required'=>true]) }}
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Arahan</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::textarea('receiver_direction', null, ['class'=>'form-control','rows'=>3]) }}
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nota Arahan</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::textarea('receiver_note', null, ['class'=>'form-control','rows'=>3]) }}
				</div>
			</div>		
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Yang Menyelesaikan</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('receiver_done_id', $user_list, null, ['id'=>'done_id','class'=>'form-control select2_single']) }}
				{{ Form::hidden('receiver_done_name', null, ['id'=>'done_name']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Jabatan Menyelesaikan</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::select('receiver_done_post_id', $post_list, null, ['id'=>'done_post_id','class'=>'form-control select2_single']) }}
				{{ Form::hidden('receiver_done_post_code', null, ['id'=>'done_post_code']) }}
				{{ Form::hidden('receiver_done_post_name', null, ['id'=>'done_post_name']) }}				
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Penyelesaian</label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::bsDatetime('receiver_done_date', !empty($data['receiver_done_date']) ? $data['receiver_done_date'] : "") }}
				</div>
			</div>				
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nota Penyelesaian</label>		
				<div class="col-md-6 col-sm-6 col-xs-12">
				{{ Form::textarea('receiver_done_note', null, ['class'=>'form-control','rows'=>3]) }}
				</div>
			</div>		
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Tipe Penerima <span style="color:red">*</span></label>		
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::select('receiver_type', $type_options, null, ['class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>			
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Status <span style="color:red">*</span></label>							
				<div class="col-md-3 col-sm-6 col-xs-12">
				{{ Form::select('receiver_status', $status_options, null, ['class'=>'form-control select2_single','required'=>true]) }}
				</div>
			</div>				
			<div class="form-group">
				<div class="col-md-3 col-md-offset-2 col-sm-6 col-sm-offset-3 col-xs-12">
					<em><span style="color:red">*</span> <small>{{ trans('site.required') }}</small></em>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
					<button type="submit" id="save" class="btn btn-success m-t-15 waves-effect"><i class="fa fa-save"></i> {{ trans('site.save') }}</button>
					<button type="button" id="back" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-undo"></i> {{ trans('site.cancel') }}</button>
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
$(document).ready(function() {

});	
</script>
@endsection

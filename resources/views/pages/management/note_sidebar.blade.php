						<div class="form-group bg-blue-grey">
							<a href="#action" role="tab" data-toggle="collapse" data-parent="#accordion" class="accordion-title">
							<h6 class="text-center">Tindak Lanjut</h6>
							</a>
						</div>		
						<div id="action" class="panel-collapse collapse" role="tabpanel">
							<div class="form-group">
								<div class="col-xs-3">{{ Form::label('Tindak Lanjut') }}</div>
@if (!empty($profile['structure_disposition']))								
								<div class="col-xs-4">
								{{ Form::radio('action', 'disposition', false, ['class'=>'flat action']) }} Disposisi
								</div>
@endif
@if ($data['receiver_status'] != "done" && $data['memo_disposition_done'] == "yes")
								<div class="col-xs-5">						
								{{ Form::radio('action', 'done', false, ['class'=>'flat action']) }} Selesai
								</div>
@endif								
							</div>
							<div class="clearfix"></div>
							<fieldset id="disposition" style="display:none">
							{{ Form::hidden('disposition_origin', !empty($data['receiver_origin']) ? $data['receiver_origin'] : null, ['id'=>'disposition_origin']) }}
							{{ Form::hidden('disposition_parent', $data['receiver_user_id'], ['id'=>'disposition_parent']) }}
							{{ Form::hidden('disposition_parent_post', $data['receiver_post_id'], ['id'=>'disposition_parent_post']) }}
							{{ Form::hidden('group', $group) }} 
							<div class="form-group">
								<div class="col-xs-4">{{ Form::label('Tujuan') }}</div>
								<div class="col-xs-8">
								{{ Form::select('direction_user[]', $user_list, null, ['id'=>'disposition_user','class'=>'form-control select2_multiple', 'multiple'=>'multiple']) }}
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">{{ Form::label('Arahan') }}</div>
								<div class="col-xs-8">
								<ul class="list-unstyled">
@foreach ($master_options['action'] as $action)
@if (!empty($action))
								<li>{{ Form::checkbox('disposition_direction[]', $action, false, ['class'=>'flat direction']) }} {{ $action }}</li>
@endif
@endforeach
								</ul>
								</div>
							</div>
							</fieldset>
							<fieldset id="note" style="display:none">
							<div class="form-group">
								<div class="col-xs-12">{{ Form::label('Catatan') }}</div>							
								<div class="col-xs-12">
								{{ Form::bsEditor('disposition_note', '') }}
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 text-right">
								<img id="loading-action" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>
								<button type="button" id="submit-action" class="btn btn-success"><i class="fa fa-save"></i> {{ trans('site.submit') }}</button>
								</div>
							</div>
							</fieldset>
						</div>
						<div class="form-group bg-blue-grey">
							<a href="#history" role="tab" data-toggle="collapse" data-parent="#accordion" class="accordion-title">
							<h6 class="text-center">Jejak</h6>
							</a>
						</div>		
						<div id="history" class="panel-collapse collapse in" role="tabpanel">
@if (!empty($data['memo_disposition']))
@foreach ($data['memo_disposition'] as $disposition)
	@if ($disposition['disposition_status'] <> "end")
							<div class="form-group form-line">
								<div class="col-xs-12">
								{{ Form::label($disposition['disposition_date']) }}
								</div>
							</div>
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Disposisi Dari') }}
								</div>
								<div class="col-xs-8">
								{{ $disposition['disposition_parent']['post_code']." | ".$disposition['disposition_parent']['name'] }}
								</div>
							</div>		
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Kepada') }}
								</div>
								<div class="col-xs-8">
								<ul class="list-unstyled">
		@if (!empty($disposition['disposition_user']))							
		@foreach ($disposition['disposition_user'] as $duser)
								<li>{!! $duser !!}</li>
		@endforeach
		@endif
								</ul>
								</div>
							</div>	
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Arahan Disposisi') }}
								</div>
								<div class="col-xs-8">
								<ul class="list-unstyled">
		@if (!empty($disposition['disposition_direction']))						
		@foreach ($disposition['disposition_direction'] as $direction)
								<li>- {{ $direction }}</li>
		@endforeach
		@endif
								</ul>
								</div>
							</div>	
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Catatan') }}
								</div>
								<div class="col-xs-8">
								{!! $disposition['disposition_note'] !!}
								</div>
							</div>
		@if (!empty($disposition['disposition_doner']))					
		@foreach ($disposition['disposition_doner'] as $doner)					
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Diselesaikan Oleh') }}
								</div>
								<div class="col-xs-8">
								{{ $doner['post_code']." | ".$doner['name'] }} <span class="pull-right"><small>{{ $doner['date'] }}</small></span>
								</div>
							</div>					
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Catatan') }}
								</div>
								<div class="col-xs-8">
								{!! $doner['note'] !!}
								</div>
							</div>	
			@if (in_array($disposition['disposition_parent_id'], $profile['user_posts']) && $data['receiver_status'] <> "done")
							<fieldset>
							{{ Form::hidden('revoke_id_'.$doner['disposition_group'], $doner['disposition_id']) }}
							{{ Form::hidden('revoke_group_'.$doner['disposition_group'], $doner['disposition_group']) }}
							{{ Form::hidden('revoke_user_'.$doner['disposition_group'], $profile['user_id']) }}							
							<div class="form-group revoke-note" style="display: none">
								<div class="col-xs-12">
								{{ Form::label('Alasan Anulir') }}
								</div>
								<div class="col-xs-12">
								{{ Form::text('revoke_note_'.$doner['disposition_group'], '', ['class'=>'form-control']) }}
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 text-right">
								<img id="loading-revoke_{{ $doner['disposition_group'] }}" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>
								<button type="button" class="btn btn-danger request-revoke"><i class="fa fa-ban"></i> {{ trans('site.revoke') }}</button>
								<button type="button" class="btn btn-success submit-revoke" title="{{ trans('site.data_revoke') }}" rel="{{ $doner['disposition_group'] }}" style="display: none"><i class="fa fa-save"></i> {{ trans('site.submit') }}</button>
								</div>
							</div>
							</fieldset>							
			@endif								
		@endforeach					
		@endif							
		@if (!empty($disposition['disposition_comment']))
							<div class="form-group form-line">
								<div class="col-xs-12">
								{{ Form::label('Tanggapan') }}
								</div>
		@foreach ($disposition['disposition_comment'] as $comment)				
								<div class="col-xs-12">
									<div class="well">
									<p><b>{{ $comment['comment_user_name'] }}</b> <span class="pull-right"><small>- {{ $comment['comment_date'] }}</small></span></p>
									<p>{{ $comment['comment_note'] }}</p>
									</div>
								</div>
		@endforeach
							</div>							
		@endif
							<p>&nbsp;</p>						
		@if ($data['receiver_status'] != "done" && $disposition['disposition_status'] != "done" && isset($disposition['disposition_can_comment']) && (empty($disposition['disposition_comment']) || (!empty($disposition['disposition_comment']) && $disposition['disposition_comment'][sizeof($disposition['disposition_comment']) - 1]['comment_user_id'] != $profile['user_id'])))	
							<fieldset>
							{{ Form::hidden('comment_group_'.$disposition['disposition_group'], $disposition['disposition_group']) }}
							{{ Form::hidden('comment_user_'.$disposition['disposition_group'], $profile['user_id']) }}
							<div class="form-group">
								<div class="col-xs-12">
								{{ Form::label('Tanggapan') }}
								</div>
								<div class="col-xs-12">
								{{ Form::text('comment_note_'.$disposition['disposition_group'], '', ['class'=>'form-control']) }}
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 text-right">
								<img id="loading-comment_{{ $disposition['disposition_group'] }}" src="{{ asset('images/logo/loading.gif') }}" class="loading-image" style="display: none;"/>																
								<button type="button" class="btn btn-success submit-comment" rel="{{ $disposition['disposition_group'] }}"><i class="fa fa-save"></i> {{ trans('site.submit') }}</button>
								</div>
							</div>
							</fieldset>
		@endif
	@endif
							<p>&nbsp;</p>
@endforeach
@endif
@if ($data['receiver_type'] <> "disposition" && $data['receiver_status'] == "done")
						<div class="form-group form-line">
								<div class="col-xs-12">
								{{ Form::label($data['receiver_done_date']) }}
								</div>
							</div>				
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Diselesaikan Oleh') }}
								</div>
								<div class="col-xs-8">
								{{ $data['receiver_done_post_code']." | ".$data['receiver_done_name'] }}
								</div>
							</div>					
							<div class="form-group form-line">
								<div class="col-xs-4">
								{{ Form::label('Catatan') }}
								</div>
								<div class="col-xs-8">
								{!! $data['receiver_done_note'] !!}
								</div>
							</div>
@endif
						</div>						
						<div class="form-group bg-blue-grey">
							<a href="#flow" role="tab" data-toggle="collapse" data-parent="#accordion" class="accordion-title">
							<h6 class="text-center">Alur</h6>
							</a>
						</div>		
						<div id="flow" class="panel-collapse collapse" role="tabpanel">
							<div class="form-group">
							<div id="tree"></div>
							</div>
						</div>						

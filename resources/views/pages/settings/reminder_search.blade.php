			<input type="hidden" value="{{ $list['page'] }}" class="page">
			<input type="hidden" value="{{ $list['pagetotal'] }}" class="pagetotal">	
@foreach ($list['data'] as $data)
			<div class="well {{ $data['reminder_color'] }}">			
				<div class="row">
					<div class="col-xs-6">{!! $data['reminder_name'] !!}</div>
					<div class="col-xs-6"><span class="pull-right"><small>{!! $data['reminder_date'] !!}</small></span></div>
				</div>
				<div class="row">
					<div class="col-xs-12">{!! $data['reminder_content'] !!}</div>
					<p>&nbsp;</p>
				</div>
				<div class="row">
					<div class="col-md-2 col-sm-3 col-xs-4"><b>Keterangan</b></div>
					<div class="col-md-10 col-sm-9 col-xs-8">{!! $data['reminder_note'] !!}</div>
				</div>				
				<div class="row">
					<div class="col-md-2 col-sm-3 col-xs-4"><b>Batas Waktu</b></div>
					<div class="col-md-10 col-sm-9 col-xs-8">{!! $data['reminder_date'] !!}</div>
				</div>				
				<div class="row">
					<div class="col-md-2 col-sm-3 col-xs-4"><b>Status</b></div>
					<div class="col-md-10 col-sm-9 col-xs-8">{!! $data['reminder_remark'] !!}</div>
				</div>								
				<div class="row">
					<div class="col-xs-12 text-right">
					{!! $data['editor'] !!}
					</div>
				</div>				
			</div>			
@endforeach
 


			<input type="hidden" value="{{ $list['page'] }}" class="page">
			<input type="hidden" value="{{ $list['pagetotal'] }}" class="pagetotal">	
@foreach ($list['data'] as $data)
			<div class="well">			
				<div class="row">
					<a href="{{ url('inbox/read/'.$data['receiver_id']) }}">
					<div class="col-xs-6">{!! $data['inbox_agenda_text'] !!}</div>
					<div class="col-xs-6"><span class="pull-right"><small>{!! $data['inbox_agenda_date'] !!}</small></span></div>
					</a>
				</div>
				<div class="row">
					<a href="{{ url('inbox/read/'.$data['receiver_id']) }}">
					<div class="col-xs-12">{!! $data['inbox_content_full'] !!}</div>
					<p>&nbsp;</p>
					</a>
				</div>
				<div class="row">
					<div class="col-xs-12">{!! $data['inbox_icon'] !!}</div>
				</div>
			</div>			
@endforeach
 


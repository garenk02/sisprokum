			<input type="hidden" value="{{ $list['page'] }}" class="page">
			<input type="hidden" value="{{ $list['pagetotal'] }}" class="pagetotal">	
@foreach ($list['data'] as $data)
			<div class="well">			
				<div class="row">
					<a href="{{ url($path.'/read/'.$data['receiver_id']) }}">
					<div class="col-xs-6">{!! !empty($data['memo_agenda_text']) ? $data['memo_agenda_text'] : "Belum Ada Nomor" !!}</div>
					<div class="col-xs-6"><span class="pull-right"><small>{!! !empty($data['memo_agenda_text']) ? $data['memo_agenda_date'] : $data['memo_date'] !!}</small></span></div>
					</a>
				</div>
				<div class="row">
					<a href="{{ url($path.'/read/'.$data['receiver_id']) }}">
					<div class="col-xs-12">{!! $data['memo_content_full'] !!}</div>
					<p>&nbsp;</p>
					</a>
				</div>
			</div>			
@endforeach
 


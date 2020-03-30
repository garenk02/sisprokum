			<input type="hidden" value="{{ $list['page'] }}" class="page">
			<input type="hidden" value="{{ $list['pagetotal'] }}" class="pagetotal">	
@foreach ($list['data'] as $data)
			<div class="well">			
				<div class="row">
					<a href="{{ url('inmemo/read/'.$data['receiver_id']) }}">
					<div class="col-xs-6">{!! !empty($data['memo_sender_post_code']) ? $data['memo_sender_post_code']." | ".$data['memo_sender_post_name'] : $data['memo_sender_post_name'] !!}</div>
					<div class="col-xs-6"><span class="pull-right"><small>{!! $data['memo_agenda_date'] !!}</small></span></div>
					</a>
				</div>
				<div class="row">
					<a href="{{ url('inmemo/read/'.$data['receiver_id']) }}">
					<div class="col-xs-12">{!! $data['memo_content_full'] !!}</div>
					<p>&nbsp;</p>
					</a>
				</div>
				<div class="row">
					<div class="col-xs-12">{!! $data['memo_icon'] !!}</div>
				</div>
			</div>			
@endforeach
 


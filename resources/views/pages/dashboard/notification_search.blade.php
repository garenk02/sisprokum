			<input type="hidden" value="{{ $list['page'] }}" class="page">
			<input type="hidden" value="{{ $list['pagetotal'] }}" class="pagetotal">				
		  <ul class="list-unstyled msg_list" role="menu">			
@foreach ($list['data'] as $data)
<!--
			<div class="well well-sm no-shadow">			
				<a href="{{ $data['link'] }}">
				<div class="row">
					<div class="col-xs-1"><span class="image"><img src="{{ $data['photo'] }}" alt="..."></span></div>
					<div class="col-xs-11">
						<div class="row">
							<div class="col-xs-6">{!! $data['name'] !!}</div>
							<div class="col-xs-6"><span class="pull-right"><small><em><b>{!! $data['date'] !!}</b></em></small></span></div>
						</div>
						<div class="row">
							<div class="col-xs-12">{!! $data['text'] !!}</div>
						</div>
					</div>
				</div>
				</a>
			</div>			
-->
			<li>
			  <a href="{{ $data['link'] }}">
				<span class="image"><img src="{{ $data['photo'] }}" alt="..."/></span>
				<span>
				  <span>{{ $data['name'] }}</span>
				  <span class="pull-right">{{ $data['date'] }}</span>
				</span>
				<span class="message">
				{{ $data['text'] }}
				</span>
			  </a>
			</li>
@endforeach
		  </ul>
                


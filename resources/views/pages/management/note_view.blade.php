	<h1 class="text-center">NOTA DINAS</h1>
	<table width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr>
		<td colspan="5" style="text-align: center">Nomor: {{ $data['memo_agenda'] }}</td>
	</tr>	
	<tr>
		<td width="20%">&nbsp;</td>
		<td width="5">&nbsp;</td>
		<td width="40%">&nbsp;</td>
		<td width="20%">&nbsp;</td>			
		<td>&nbsp;</td>	
	</tr>		
	<tr>
		<td>Yang Terhormat</td>
		<td>&nbsp;:&nbsp;</td>
		<td colspan="3">
@if (sizeof($data['memo_receiver']) > 1)
<ul class="list-receiver">
	@foreach ($data['memo_receiver'] as $row => $receiver)
	<li>
	@if ($row == 0)
	<span class="pull-right">&nbsp;&nbsp; {{ $data['memo_date_print'] }}</span>
	@endif	
	{!! ($row + 1).". ".$receiver['post_text'] !!}
	</li>
	@endforeach
</ul>		
@else
	@foreach ($data['memo_receiver'] as $receiver)
	<span class="pull-right">&nbsp;&nbsp; {{ $data['memo_date_print'] }}</span> {!! $receiver['post_text'] !!}
	@endforeach
@endif
		</td>		
	</tr>
	<tr>
		<td>Dari</td>
		<td>&nbsp;:&nbsp;</td>
		<td colspan="3">{{ !empty($data['memo_represent_id']) ? $data['memo_represent_name'] : ((!empty($data['memo_sender_post_type']) ? $data['memo_sender_post_type_text']." " : "") . $data['memo_sender_post_name']) }}</td>
	</tr>	
	<tr>
		<td>Sifat</td>
		<td>&nbsp;:&nbsp;</td>
		<td colspan="3">{{ $data['memo_level'] }}</td>
	</tr>	
	<tr>
		<td>Lampiran</td>
		<td>&nbsp;:&nbsp;</td>
		<td colspan="3">{{ $data['memo_file_note'] }}</td>
	</tr>		
	<tr>
		<td>Hal</td>
		<td>&nbsp;:&nbsp;</td>
		<td colspan="3">{{ $data['memo_title'] }}</td>
	</tr>	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="5">
		<div>{!! $data['memo_content'] !!}</div>		
		</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	</tr>
@if (!empty($data['memo_represent_id']))
	<tr>
		<td colspan="3" style="text-align: right">a.n.&nbsp;</td>
		<td colspan="2">{{ $data['memo_represent_name'] }}</td>
	</tr>
@endif
	<tr>
		<td colspan="3" style="text-align: right">{{ (!empty($data['memo_sender_post_type']) ? $data['memo_sender_post_type_text']."&nbsp;" : "&nbsp;") }}</td>
		<td colspan="2">{{ $data['memo_sender_post_name'] }},</td>
	</tr>
@if (!empty($data['memo_sender_signature']) && $data['memo_status'] == "done")
	<tr>
		<td colspan="3">&nbsp;</td>
		<td colspan="2"><img src="{{ asset('images/users/'.$data['memo_sender_signature']) }}" class="signature"></td>
	</tr>	
@else
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
@endif	
	<tr>
		<td colspan="3">&nbsp;</td>
		<td colspan="2">{{ $data['memo_sender_name'] }}<br/>NIP: {{ $data['memo_sender_pin'] }}</td>
	</tr>	
@if (!empty($data['memo_cc']))	
	<tr>
		<td colspan="5">Tembusan:<br/>
@foreach ($data['memo_cc'] as $row => $cc)
		{{ (sizeof($data['memo_cc']) > 1) ? $row + 1 .". ". $cc['post'] : $cc['post'] }}<br/>
@endforeach
		</td>
	</tr>	
@endif	
	</table>
	
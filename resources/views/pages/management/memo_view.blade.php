	<h1 class="text-center">MEMORANDUM</h1>
	<table width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr>
		<td width="30%">&nbsp;</td>
		<td width="5">&nbsp;</td>
		<td width="25%">&nbsp;</td>
		<td width="30%">&nbsp;</td>
		<td>&nbsp;</td>		
	</tr>	
	<tr>
		<td>Yang Terhormat</td>
		<td>&nbsp;:&nbsp;</td>
		<td colspan="3">
@if (sizeof($data['memo_receiver']) > 1)
<ul>
	@foreach ($data['memo_receiver'] as $row => $receiver)
	<li>{{ ($row + 1).". ".$receiver['post'] }}</li>
	@endforeach
</ul>
@else
	@foreach ($data['memo_receiver'] as $receiver)
	{{ $receiver['post'] }}
	@endforeach
@endif
		</td>
	</tr>
	<tr>
		<td>Dari</td>
		<td>&nbsp;:&nbsp;</td>
		<td colspan="3">{{ $data['memo_sender_post_name'] }}</td>
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
		<div>{!! preg_match('/<tr/i', $data['memo_content']) ? strip_tags($data['memo_content']) : $data['memo_content'] !!}</div>
		</td>
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
		<td colspan="2">{{ $data['memo_date_print'] }}</td>
	</tr>
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
		<td colspan="2">{{ $data['memo_sender_name'] }}</td>		
	</tr>	
	</table>
	
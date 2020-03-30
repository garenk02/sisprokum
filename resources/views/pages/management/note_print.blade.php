<html>
<head>
<style>
body {
	font-family: Arial;
	font-size: 14pt;
	background: rgb(204,204,204); 
}
h1 {
	font-size: 18pt;
	font-weight: bold;
	margin: 0;
	padding: 0;
}
h2 {
	font-size: 16pt;
}
page[size="A4"] {
	background: white;
	width: 21cm;
	max-width: 21cm;
	min-height: 29.7cm;
	height: auto;
	display: block;
	margin: 0 auto;
	margin-bottom: 0.5cm;
}
table {
	font-family: Arial;
	font-size: 14pt;	
	line-height: 17.5pt;
}
th {
	vertical-align: top;	
}
td {
	vertical-align: top;
	padding: 0;
}
#container {
	width: 90%;
	margin: 0;
}
#container th {
	font-weight: bold;
	text-align: center;
}
#container td {
	padding: 0;	
}
p {
	padding: 0;	
}
#printout {
	text-align: left;
	margin: 0;
}
@media print {
	body, page[size="A4"] {
		padding: 0;
		margin: 0;
	}
	#container {
		width: 86%;
	}	
}
.list-receiver {
	padding-left: 0;
	list-style: none;
}
.pull-right {
	float: right !important;	
}
</style>
</head>

<body onload="print()">
<page size="A4">
	<center>
	<p style="height: 210px">&nbsp;</p>
	<h1>NOTA DINAS</h1>
	<table id="container" cellpadding="1" cellspacing="1" border="0">
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
</center>
</page>
<!-- jQuery -->
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script language="javascript">
$(document).ready(function() 
{
	
});	
</script>
</body>
</html>

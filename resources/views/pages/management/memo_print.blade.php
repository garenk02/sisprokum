<html>
<head>
<style>
body {
	font-family: Arial;
	font-size: 16pt;
	background: rgb(204,204,204);
}
h1 {
	font-size: 19pt;
	font-weight: bold;
	margin: 0;
	padding: 0;
}
h2 {
	font-size: 16pt;
}
page[size="A5"] {
	background: white;
	width: 16.5cm;
	max-width: 16.5cm;
	min-height: 21.5cm;
	height: auto;
	display: block;
	margin: 0 auto;
	margin-bottom: 0.5cm;
}
table {
	font-family: Arial;
	font-size: 16pt;	
	line-height: 19.5pt;
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
	body, page[size="A5"] {
		padding: 0;
		margin: 0;
		box-shadow: 0;
	}
	#container {
		width: 100%;
	}
}
</style>
</head>

<body onload="print()">
<page size="A5">
	<center>
	<p style="height: 225px">&nbsp;</p>
	<h1>MEMORANDUM</h1>
	<table id="container" cellpadding="1" cellspacing="1" border="0">
	<tr>
		<td width="30%">&nbsp;</td>
		<td width="5">&nbsp;</td>
		<td width="30%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
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

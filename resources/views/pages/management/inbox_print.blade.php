<html>
<head>
<style>
body {
	font-family: Arial;
	font-size: 12px;
	background: rgb(204,204,204); 
}
h1 {
	font-size: 16px;
}
h2 {
	font-size: 14px;
}
page[size="A4"] {
	background: white;
	width: 21cm;
	min-height: 29.7cm;
	height: auto;
	display: block;
	margin: 0 auto;
	margin-bottom: 0.5cm;
}
@media print {
	body, page[size="A4"] {
		margin: 0;
		box-shadow: 0;
	}
}
table {
	font-family: Arial;
	font-size: 12px;	
}
th {
	vertical-align: top;	
}
td {
	vertical-align: top;
	padding: 0;
}
#container {
	width: 95%;
	margin: 1%;
}
#container th {
	font-weight: bold;
	text-align: center;
}
#container td {
	padding: 5px;	
}
p {
	padding: 0 5px;	
}
#printout {
	text-align: left;
	margin: 0 5%;
}
</style>
</head>

<body onload="print()">
<page size="A4">
	<center>	
	<p>&nbsp;</p>
	<h2>FORMULIR PENYELESAIAN SURAT DINAS</h2>
	<h1>DIREKTORAT JENDERAL ENERGI BARU, TERBARUKAN DAN KONSERVASI ENERGI</h1>
	<p>&nbsp;</p>
	<p id="printout">Dicetak oleh: {{ $profile['user_name']." / ".date('d-m-Y')." / ".date('H:i:s') }}</p>
	<table id="container" cellpadding="1" cellspacing="1" border="1">
	<tr>
		<th colspan="4">DATA DAN INFORMASI SURAT</th>
	</tr>
	<tr>
		<td colspan="2" width="50%">
		<table border="0" width="100%">
		<tr>
			<td width="40%">Nomor Agenda</td>
			<td>: {{ $data['inbox_agenda'] }}</td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{ $data['inbox_agenda_date_text'] }}</td>
		</tr>
		</table>
		</td>
		<td colspan="2">
		<table border="0" width="100%">
		<tr>
			<td width="40%">Nomor Surat</td>
			<td>: {{ $data['inbox_number_text'] }}</td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{ $data['inbox_date_text'] }}</td>
		</tr>
		</table>	
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<table border="0" width="100%">
		<tr>
			<td width="40%">Hal</td>
			<td>:</td>
		</tr>
		<tr>
			<td colspan="2">
			<div>{!! preg_match('/<tr/i', $data['inbox_content']) ? strip_tags($data['inbox_content']) : $data['inbox_content'] !!}</div>
			</td>
		</tr>		
		</table>
		</td>
		<td colspan="2">
		<table border="0" width="100%">
		<tr>
			<td width="40%">Asal Surat</td>
			<td>:</td>
		</tr>
		<tr>
			<td colspan="2">{{ $data['inbox_sender_post_name']." | ".$data['inbox_sender_post_unit'] }}</td>
		</tr>
		</table>		
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<table border="0" width="100%">
		<tr>
			<td width="40%">Kode Arsip/Masalah</td>
			<td>: {{ $data['inbox_agenda_class'] }}</td>	
		</tr>
		</table>	
		</td>	
		<td colspan="2">
		<table border="0" width="100%">
		<tr>
			<td width="40%">Tunjuk Silang</td>
			<td>:</td>	
		</tr>
		<tr>
			<td colspan="2">
@if (!empty($data['inbox_relation']))
@foreach ($data['inbox_relation'] as $row => $relation)		
		{{ $row == 0 ? $relation['relation_agenda'] : ", ".$relation['relation_agenda'] }}
@endforeach
@endif			
			</td>
		</tr>	
		</table>	
		</td>
	</tr>
	<tr>
		<td width="11%">
		<table border="0" width="100%">
		<tr>
			<td>Retensi</td>
		</tr>
		</table>
		</td>
		<td>
		<table border="0" width="100%">
		<tr>
			<td width="23%">Aktif</td>
			<td>: {{ $data['inbox_meta_active_date_text'] }}</td>
		</tr>
		<tr>
			<td>In-Aktif</td>
			<td>: {{ $data['inbox_meta_inactive_date_text'] }}</td>
		</tr>	
		</table>
		</td>
		<td colspan="2">
		<table border="0" width="100%">
		<tr>
			<td width="40%">Lokasi Simpan</td>
			<td>:</td>	
		</tr>
		<tr>
			<td colspan="2">Tata Usaha
@foreach ($data['inbox_receiver'] as $row => $receiver)
		{{ !empty($receiver['code']) ? ($row == 0 ? $receiver['code'] : ", ".$receiver['code']) : "" }}
@endforeach
@foreach ($data['inbox_cc'] as $row => $cc)
		{{ !empty($cc['code']) ? ($row == 0 && sizeof($data['inbox_receiver']) == 0 ? $cc['code'] : ", ".$cc['code']) : "" }}
@endforeach		
			</td>
		</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<table border="0" width="100%">
		<tr>
			<td width="20%">Tujuan Surat</td>
			<td>: 
@foreach ($data['inbox_receiver'] as $row => $receiver)		
			{{ $row == 0 ? (!empty($receiver['code']) ? $receiver['code'] : $receiver['name']) : (!empty($receiver['code']) ? ", ".$receiver['code'] : ", ".$receiver['name']) }}
@endforeach		
			</td>
		</tr>
		<tr>
			<td>Tembusan</td>
			<td>: 
@foreach ($data['inbox_cc'] as $row => $cc)
			{{ $row == 0 ? (!empty($cc['code']) ? $cc['code'] : $cc['name']) : (!empty($cc['code']) ? ", ".$cc['code'] : ", ".$cc['name']) }}
@endforeach	
			</td>
		</tr>
		<tr>
			<td>Lampiran</td>
			<td>: {{ $data['inbox_file_number'] ." ". (!empty($data['inbox_file_number']) ? $data['inbox_file_unit'] : "") ." | ". $data['inbox_file_note'] }}</td>
		</tr>	
		<tr>
			<td>Tingkat Perkembangan</td>
			<td>: {{ $data['inbox_meta_type'] }}</td>
		</tr>	
		<tr>
			<td>Tingkat Urgensi</td>
			<td>: {{ $data['inbox_level'] }}</td>
		</tr>	
		<tr>
			<td>Sifat Naskah</td>
			<td>: {{ $data['inbox_class'] }}</td>
		</tr>		
		</table>	
		</td>
	</tr>
	<tr>
		<th colspan="4">JEJAK DISPOSISI SURAT</th>
	</tr>
@if (!empty($data['inbox_disposition']))
@for ($row = 1; $row <= ceil(sizeof($data['inbox_disposition']) / 2); $row++)	
	<tr>
	@for ($col = 1; $col <= 2; $col++)  	
<!-- $key = ($row - 1) + (($col - 1) * ceil(sizeof($data['inbox_disposition']) / 2)) -->	
	@if (!empty($data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]))	
		<td colspan="2">
		<table border="0" width="100%">
			<tr>
				<td colspan="4"><b><u>{{ $data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_date'] }}</u></b></td>
			</tr>
			<tr>
				<td width="5px">{{ ($row - 1) + ($col - 1) + (($row - 1) * 1) + 1 }}. </td>
				<td width="25%">Dari</td>
				<td width="5px">:</td>
				<td>{{ $data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_parent']['post_code'] ." | ". $data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_parent']['name'] }}</td>
			</tr> 
			<tr>
				<td>&nbsp;</td>
				<td>Kepada</td>
				<td>:</td>
				<td>
			@foreach ($data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_user'] as $duser)
				{{ $duser }}<br>
			@endforeach
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Arahan</td>
				<td>:</td>
				<td>
@if (!empty($data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_direction']))				
			@foreach ($data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_direction'] as $direction)
				- {{ $direction }}<br>
			@endforeach
@endif
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Catatan</td>
				<td>:</td>
				<td><div>{!! preg_match('/<tr/i', $data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_note']) ? strip_tags($data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_note']) : $data['inbox_disposition'][($row - 1) + ($col - 1) + (($row - 1) * 1)]['disposition_note'] !!}</div></td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>			
		</table>
		</td>
	@endif
	@endfor
	</tr>			
@endfor
@else
	<tr>	
		<td colspan="2"><div style="height: 100px">&nbsp;</div></td>
		<td colspan="2"><div style="height: 100px">&nbsp;</div></td>		
	</tr>	
@endif
@if ($data['receiver_type'] <> "disposition" && $data['receiver_status'] == "done")
	<tr>	
		<td colspan="2">	
		<table border="0" width="100%">
			<tr>
				<td colspan="4"><b><u>{{ $data['receiver_done_date'] }}</u></b></td>
			</tr>
			<tr>
				<td width="5px">{{ sizeof($data['inbox_disposition']) + 1 }}. </td>
				<td width="25%">Diselesaikan oleh</td>
				<td width="5px">:</td>
				<td>{{ $data['receiver_done_post_code'] ." | ". $data['receiver_done_name'] }}</td>
			</tr> 
			<tr>
				<td>&nbsp;</td>
				<td>Catatan</td>
				<td>:</td>
				<td><div>{!! preg_match('/<tr/i', $data['receiver_done_note']) ? strip_tags($data['receiver_done_note']) : $data['receiver_done_note'] !!}</div></td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>			
		</table>
		</td>
	</tr>
@endif

	</table>
	<p>&nbsp;</p>
</center>
</page>
</body>
</html>

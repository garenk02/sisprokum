<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SK - {{ $produk->nomor }} - {{ $produk->tahun }} - {{ $produk->judul }}</title>
    <style>
        @page {
            margin: 2.5cm;
        }
        body {
            font-family: Bookman Old Style;
            font-size: 14px;
        }
        table { border: 0 }
        .footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px; }
        .center { text-align: center}
    </style>
</head>
<body>
    <div class="center">
        <img src="{{ storage_path('app/images/logo-kemenag-bw.png') }}" width="120" height="120"/>
        <p>
            KEPUTUSAN DIREKTUR JENDERAL BIMBINGAN MASYARAKAT KRISTEN<br>
            KEMENTERIAN AGAMA REPUBLIK INDONESIA<br>
            NOMOR {{ $produk->nomor }} TAHUN {{ $produk->tahun }}<br>
            TENTANG<br>
            {{ strtoupper($produk->judul) }}<br><br>
            DENGAN RAHMAT TUHAN YANG MAHA ESA<br><br>
            DIREKTUR JENDERAL BIMBINGAN MASYARAKAT KRISTEN
        </p>
    </div>
    <div>
        {!! $produk->isi !!}
    </div>
    <table border="0" width="100%" style="margin-top:20px;">
        <tr>
            <td width="55%" valign="bottom">
                @if ($produk->status == 1)
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(130)->merge('/storage/app/images/logo-kemenag.png')->generate('SK Nomor: '.$produk->nomor.' Tahun: '.$produk->tahun.' Tentang: '.$produk->judul)) !!} ">
                @endif
            </td>
            <td width="45%" valign="bottom">
                Ditetapkan di {{ $produk->kota }}<br>
                pada tanggal {{ Carbon\Carbon::parse($produk->tanggal)->translatedFormat('d F Y') }}<br><br>
                DIREKTUR JENDERAL<br>
                BIMBINGAN MASYARAKAT KRISTEN,<br><br>
                <br><br><br><br>
                {{ config('dirjen.name', 'THOMAS PENTURY') }}
            </td>
        </tr>
    </table>
    <div class="footer"></div>
</body>
</html>

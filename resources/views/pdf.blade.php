<!DOCTYPE html>
<html>
<head>
    <title>SK - {{ $produk->nomor }} - {{ $produk->tahun }} - {{ $produk->judul }}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }
        body {
            font-family: Bookman Old Style;
            font-size: 14px;
            margin-top: 3cm;
            margin-left: 2.5cm;
            margin-right: 2.5cm;
            margin-bottom: 2.5cm;
        }
        main { clear: both, margin: 10px 0; }
        table { border: 0 }
        .center { text-align: center}
        .last { position: absolute; margin-top: 20px; left: 0px; right: 0px; }
    </style>
</head>
<body>
    <center>
        <img src="{{ storage_path('app/images/logo-kemenag-bw.png') }}" width="120" height="120" />
    </center>
    <p class="center">
        KEPUTUSAN DIREKTUR JENDERAL BIMBINGAN MASYARAKAT KRISTEN<br>
        KEMENTERIAN AGAMA REPUBLIK INDONESIA<br>
        NOMOR {{ $produk->nomor }} TAHUN {{ $produk->tahun }}<br>
        TENTANG<br>
        {{ $produk->judul }}<br><br>
        DENGAN RAHMAT TUHAN YANG MAHA ESA<br><br>
        DIREKTUR JENDERAL BIMBINGAN MASYARAKAT KRISTEN<br>
    </p>
    <main>
        <div style="margin-bottom:10px;">
            {!! $produk->isi !!}
        </div>
    </main>
    <div class="last">
        <table border="0" width="100%" style="margin-top:10px;">
            <tr>
                <td width="55%" valign="bottom">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(130)->merge('/storage/app/images/logo-kemenag.png')->generate('SK Nomor: '.$produk->nomor.' Tahun: '.$produk->tahun.' Tentang: '.$produk->judul)) !!} ">
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
    </div>
</body>
</html>

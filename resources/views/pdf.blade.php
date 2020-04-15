<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SK - {{ $produk->nomor }} - {{ $produk->tahun }} - {{ $produk->judul }}</title>
    <style>
        @page {
            margin-top: 2cm;
            margin-right: 2.5cm;
            margin-bottom: 2.5cm;
            margin-left: 2.5cm;
        }
        body {
            font-family: Bookman Old Style;
            font-size: 14px;
        }
        .footer { position: fixed; left: 0px; bottom: -190px; right: 0px; height: 185px; }
        .center { text-align: center}
        div.content > table { border: 0 }
        div.footer > table.extra { border-collapse: collapse; }
        div.footer > table.extra, table.extra td { border: 1px solid black; }
        #watermark {
            position: fixed;
            top: 23%;
            width: 100%;
            text-align: center;
            opacity: .06;
            transform: rotate(40deg);
            transform-origin: 50% 50%;
            z-index: -1000;
            font-size: 220px;
        }
    </style>
</head>
<body>
    @if($produk->status == 0)
        <div id="watermark">
            DRAF
        </div>
    @endif
    <div class="footer">
        @if($produk->status == 0 && $produk->extra)
            <table cellpadding="0" cellspacing="0" width="100%" class="extra">
                <tr>
                    @foreach($produk->extra as $data)
                        <td align="center">{{ $data['jabatan'] }}</td>
                    @endforeach
                </tr>
                <tr>
                    @foreach($produk->extra as $data)
                        <td align="center"><br><br></td>
                    @endforeach
                </tr>
            </table>
        @endif
    </div>
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
    <div class="content">
        {!! $produk->isi !!}
    </div>
    <table border="0" width="100%" style="margin-top:20px;">
        <tr>
            <td width="55%" valign="bottom">
                @if ($produk->status == 1)
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(130)->merge('/storage/app/images/logo-kemenag.png')->generate(url('/unduh/publik/'.$produk->kode_acak))) !!} ">
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
</body>
</html>

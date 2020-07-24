<!doctype html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Halaman Tidak Ditemukan | eProduk Hukum - eProKum</title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body { font-family: 'Open Sans', sans-serif; font-size: 15px; font-weight: 400; color: #000; text-align: center; }
            a { color: #a365bc; border-bottom: 1px dashed #a365bc; text-decoration: none; transition: all .3s; }
            a:hover, a:focus { color: #a365bc; border: 0; text-decoration: none; }
            h1 { font-size: 28px; font-weight: 300; color: #555; line-height: 46px; }
            ::-moz-selection { background: #8542a0; color: #fff; text-shadow: none; }
            ::selection { background: #8542a0; color: #fff; text-shadow: none; }
            p { padding: 0 }
            h1 {
                color:#000;
                font-size:40px;
                font-style: italic;
                font-weight:bold;
                padding:20px 0;
            }
            .logo {
                margin-bottom: 20px;
                width: 120px;
                height: auto;
            }
        </style>
    </head>
    <body class="h-100">
    	<div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12 col-md-12 col-lg-12">
                    <img src="{{ asset('storage/images/logo_kemenag.png') }}" title="Logo Kemenag RI" class="logo" />
                    <div class="form-group">
                        <p>SISTEM INFORMASI PRODUK HUKUM<br>(eProKum)</p>
                    </div>
                    <div class="form-group">
                        <h1>
                            Maaf, halaman tidak ditemukan.
                        </h1>
                    </div>
                    <p><a href="/" class="btn btn-success btn-sm">&laquo; Kembali</a></p>
                    <p class="copyright">
                        Direktorat Jenderal Bimbingan Masyarakat Kristen<br>
                        Kementerian Agama Republik Indonesia<br>&copy; {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>

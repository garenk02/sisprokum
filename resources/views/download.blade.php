<!doctype html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Unduh SK - Sistem Informasi Produk Hukum</title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body { font-family: 'Open Sans', sans-serif; font-size: 15px; font-weight: 400; color: #888; line-height: 30px; text-align: center; }
            a { color: #a365bc; border-bottom: 1px dashed #a365bc; text-decoration: none; transition: all .3s; }
            a:hover, a:focus { color: #a365bc; border: 0; text-decoration: none; }
            h1 { font-size: 28px; font-weight: 300; color: #555; line-height: 46px; }
            ::-moz-selection { background: #8542a0; color: #fff; text-shadow: none; }
            ::selection { background: #8542a0; color: #fff; text-shadow: none; }
            .form-example { padding: 20px 0; }
            .form-example p.description { margin-bottom: 20px; }
            .form-example p.copyright { margin-top: 40px; font-size: 12px; line-height: 15px; }
            .form-example .form-group { text-align: left; }
            .form-example input[type="text"] {
                background: none; border: 1px solid #ddd;
                font-family: 'Open Sans', sans-serif; font-size: 15px; font-weight: 400; color: #888;
                box-shadow: none;
            }
            .form-example input[type="text"]:focus { outline: 0; background: none; border: 1px solid #a365bc; box-shadow: none; }
            .form-example input[type="text"]::-moz-placeholder { color: #bbb; font-style: italic; }
            .form-example input[type="text"]:-ms-input-placeholder { color: #bbb; font-style: italic; }
            .form-example input[type="text"]::-webkit-input-placeholder { color: #bbb; font-style: italic; }
            .form-example button.btn-customized {
                margin-top: 1rem;
                padding: .75rem 1.5rem;
                background: green;
                border: 0;
                font-family: 'Open Sans', sans-serif;
                font-size: 15px;
                font-weight: 400; color: #fff;
                box-shadow: none;
            }
            .form-example button.btn-customized:hover,
            .form-example button.btn-customized:active,
            .form-example button.btn-customized:focus,
            .form-example button.btn-customized:active:focus,
            .form-example button.btn-customized.active:focus,
            .form-example button.btn.btn-primary:not(:disabled):not(.disabled):active,
            .form-example button.btn.btn-primary:not(:disabled):not(.disabled):active:focus {
                outline: 0; background: #8542a0; border: 0; color: #fff; box-shadow: none;
            }
        </style>
    </head>
    <body class="h-100">
    	<div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-10 col-md-8 col-lg-6">
                    <img src="{{ asset('storage/images/logo-kemenag.png') }}" title="Logo Kemenag RI" />
                	<form class="form-example" action="/unduh/publik/{{ $produk->kode_acak }}" method="post" accept-charset="UTF-8">
                        @csrf
                        <input type="hidden" name="_key" value="{{ $produk->kode_acak }}">
                        <h1>Unduh Produk Hukum</h1>
                		<p class="description">
                            Masukkan kata sandi untuk mengunduh
                        </p>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                		<div class="form-group">
                            <input type="text" class="form-control" id="sandi" name="sandi" placeholder="Masukkan Sandi..." maxlength="10" required>
                		</div>
						<button type="submit" class="btn btn-success btn-customized">Unduh Sekarang</button>
                		<p class="copyright">
                            Direktorat Jenderal Bimbingan Masyarakat Kristen<br>
                            Kementerian Agama Republik Indonesia<br>&copy; {{ date('Y') }}
                        </p>
                	</form>
                </div>
            </div>
        </div>
    </body>
</html>

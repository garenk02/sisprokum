<!DOCTYPE html>
<html>
    <head>
        <title>Unduh SK - Sistem Informasi Produk Hukum</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .content {
                text-align: center;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .sub-title {
                font-size: 24px;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="sub-title m-b-md">Masukkan sandi untuk mengunduh</div>
                <form action="/unduh/publik/{{ $produk->kode_acak }}" method="post" accept-charset="UTF-8">
                    @csrf
                    <input type="hidden" name="_key" value="{{ $produk->kode_acak }}">
                    <div class="form-group">
                        <input type="text" class="form-control" id="sandi" name="sandi" placeholder="Sandi" required>
                    </div>
                    <button type="submit" class="btn btn-success">Unduh Sekarang</button>
                </form>
            </div>
        </div>
    </body>
</html>

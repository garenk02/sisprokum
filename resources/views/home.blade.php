<!DOCTYPE html>
<html>
    <head>
        <title>eProduk Hukum - eProKum</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
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
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 40px;
                font-weight: 200;
            }
            .sub-title {
                font-size: 24px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .table {
                color: #000000;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <img src="{{ asset('storage/images/logo-kemenag.png') }}" title="Logo Kemenag RI" />
                <div class="title">eProduk Hukum - eProKum</div>
                <div class="sub-title m-b-md">Direktorat Jenderal Bimbingan Masyarakat Kristen</div>
                <div class="container">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Tahun</th>
                                <th>Judul/Tentang</th>
                                <th width="100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <p>Kementerian Agama Republik Indonesia &copy; {{ date('Y') }}</p>
        </div>
    </body>
    <script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('home.index') }}",
            columns: [
                {data: 'nomor', name: 'nomor'},
                {data: 'tahun', name: 'tahun'},
                {data: 'judul', name: 'judul', className: 'dt-body-left'},
                {data: 'action', name: 'aksi', orderable: false, searchable: false},
            ]
        });
    });
    </script>
</html>

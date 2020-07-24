<!DOCTYPE html>
<html>
    <head>
        <title>eProduk Hukum - eProKum</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
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
                color: #fff;
                font-size: 40px;
                font-weight: bold;
            }
            .sub-title {
                color: #fff;
                font-size: 24px;
                font-weight: bold;
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
            .logo {
                margin-top: 30px;
                width: 120px;
                height: auto;
            }
            #header-fe {
                background-image: url("{{ asset('storage/images/bg-gedung-thamrin.jpeg') }}");
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div id="header-fe">
                    <img src="{{ asset('storage/images/logo_kemenag.png') }}" title="Logo Kemenag RI" class="logo"/>
                    <div class="title">eProduk Hukum (eProKum)</div>
                    <div class="sub-title m-b-md">Direktorat Jenderal Bimbingan Masyarakat Kristen</div>
                </div>
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
                <p>Kementerian Agama Republik Indonesia<br>&copy; {{ date('Y') }}</p>
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
            ],
            language: {
                sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
                sProcessing: "Sedang memproses...",
                sLengthMenu: "Tampilkan _MENU_",
                sZeroRecords: "Tidak ditemukan data yang sesuai",
                sInfo: "Menampilkan _START_ - _END_ dari total _TOTAL_",
                sInfoEmpty: "Menampilkan 0 data",
                sInfoFiltered: "(disaring dari _MAX_ data)",
                sInfoPostFix: "",
                sSearch: "Cari:",
                sUrl: "",
                oPaginate: {
                    sFirst: "Awal",
                    sPrevious: "Sebelumnya",
                    sNext: "Berikutnya",
                    sLast: "Akhir"
                }
            }
        });
    });
    </script>
</html>

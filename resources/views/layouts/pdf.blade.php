@php
    date_default_timezone_set('Asia/Jakarta');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            margin: 130px 0px;
            margin-bottom: 0px;
        }
        header {
            position: fixed;
            top: -100px;
            /* left: 0px;
            right: 0px; */
            height: 50px;
        }
        .d-center{
            margin-left: 75px;
            margin-right: 55px;
        }
        body{
            margin-left: 70px;
            margin-right: 70px;
            margin-top: 50px;
            background: rebeccapurple;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        #logo{
            display: inline-block;
            width: 110px;height: 110px;
        }
        .text-center{
            text-align: center;
        }
        .kop{
            margin-top: 24px;
            display: inline-block;
            width: 80%;
        }.kop h3{
            font-weight: normal;
            margin: 0;
        }
        .lb{
            font-size: 21px;
        }
        .s-1{
            letter-spacing: 2px;
        }
        .header{
            /* background: blue; */
        }
        .title h3{
            font-family: serif;
            text-decoration: underline;
            text-decoration-color: black;
            text-decoration-style: solid;
            text-decoration-line: 2px;
        }
        .text-sm{
            font-size: 9px;
        }
        table{
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #27282a;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #27282a;
        }
        .table td{
            padding: 5px 10px;
        }
        p{
            font-family: serif;
            font-size: 16px;
            margin: 5px 0;
        }
        .content{
            margin-left: 25px;
        }
        .data{
            display: inline-block;
            width: 90%;
            border-bottom: 1px solid black;
        }
        .underline{
            text-decoration: underline;
        }
        .signature{
            margin: 0 auto;
            display: inline-block;
            height: 80px;
            width: 210px;
            border-bottom: 1px solid black;
        }
        .pagebreak{
            page-break-before: always;
        }
    </style>
    @yield('style')
</head>
<body>
    <header>
        <div class="d-center">
            <img id="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-pdf.png')))}}" alt="">
            <div class="kop text-center">
                <h3 class="s-1">PEMERINTAH PROVINSI JAWA TIMUR</h3>
                <h3 class="s-1">DINAS PENDIDIKAN</h3>
                <h3 class="lb">SEKOLAH MENENGAH KEJURUAN NEGERI 5</h3>
                <h3 class="lb">SURABAYA</h3>
                <p class="text-sm" style="margin: 0;">Jl. Mayjend. Prof. Dr. Mustopo 167-169 Telp. 031-5934888, 5928703, 5924994 Fax. 031-5924990 Email: stemba5sby@gmail.com</p>
                <h3 class="lb" style="display: inline;margin-left: 185px">SURABAYA</h3>
                <h6 style="display: inline;margin-left: 100px;font-weight:normal">Kode Pos 60285</h6>
            </div>
        </div>
    </header>
    @yield('content')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            margin-left: 70px;
            margin-right: 70px;
            margin-top: 50px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        #logo{
            display: inline-block;
            width: 120px;height: 120px;
        }
        .text-center{
            text-align: center;
        }
        .kop{
            display: inline-block;
            width: 80%;
        }
        .header{
            /* background: blue; */
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
    </style>
</head>
<body>
    <div class="header">
        <img id="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-pdf.png')))}}" alt="">
        <div class="kop text-center">
            <h4>PEMERINTAH PROVINSI JAWA TIMUR</h4>
            <h4>DINAS PENDIDIKAN</h4>
            <h4>SEKOLAH MENENGAH KEJURUAN NEGERI 5</h4>
            <h4>SURABAYA</h4>
            <p class="text-sm">Jl. Mayjend. Prof. Dr. Mustopo 167-169 Telp. 031-5934888, 5928703, 5924994 Fax. 031-5924990 Email: stemba5sby@gmail.com</p>
            <h4 style="display: inline;margin-left: 185px">SURABAYA</h4>
            <h6 style="display: inline;margin-left: 100px">Kode Pos 60285</h6>
        </div>
        <div class="title text-center">
            <h4>Pelaksanaan Program Bimbingan Konseling</h4>
        </div>
        <div class="content">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td><td id="detail-_id">{{$peserta->_id}}</td>
                </tr>
                <tr>
                    <td>Jadwal Konseling</td><td id="detail-jadwal">{{$peserta->jadwal}}</td>
                </tr>
                <tr>
                    <td>Pukul</td><td id="detail-pukul">{{$peserta->pukul}}</td>
                </tr>
                <tr>
                    <td>Nama Siswa</td><td id="detail-nama">{{$peserta->nama}}</td>
                </tr>
                <tr>
                    <td>Nama Guru BK</td><td id="detail-guru_bk">{{$peserta->guruBk->name}}</td>
                </tr>
                <tr>
                    <td>Perihal Bimbingan</td><td id="detail-perihal_bimbingan">{{$peserta->perihal_bimbingan}}</td>
                </tr>
                <tr>
                    <td>Link Virtual Meet</td><td id="detail-link">{{$peserta->link}}</td>
                </tr>
                <tr>
                    <td>Dibuat</td><td id="detail-created_at">{{$peserta->created_at}}</td>
                </tr>
                <tr>
                    <td>Diedit</td><td id="detail-updated_at">{{$peserta->updated_at}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

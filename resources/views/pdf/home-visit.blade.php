@php
    date_default_timezone_set('Asia/Jakarta');
    function underline($text,$max){
        $result=$text;
        if(strlen($text)<=$max){
            for($i=1;$i<=($max-strlen($text));$i++){
                $result.='&nbsp;';
            }
        }
        return $result;
    }
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
    <div class="header">
        <div class="title text-center">
            <h3>SURAT KETERANGAN KUNJUNGAN RUMAH</h3>
        </div>
        <div class="content">
            <p>Yang bertanda tangan dibawah ini, kami orangtua/wali murid dari siswa :</p>
            <table>
                <tr>
                    <td style="width: 125px"><p>Nama</p></td>
                    <td style="width: 13px"><p>:</p></td>
                    <td><p class="data">{{$homeVisit->siswa->siswa_nama}}</p></td>
                </tr>
                <tr>
                    <td><p>Kelas/NIS</p></td>
                    <td><p>:</p></td>
                    <td><p class="data">{{$homeVisit->siswa->kelas->kelasjurusan_kode}} - {{$homeVisit->siswa->siswa_nim}}</p></td>
                </tr>
                <tr>
                    <td><p>Program Keahlian</p></td>
                    <td><p>:</p></td>
                    <td><p class="data">{{$homeVisit->siswa->kelas->kelasjurusan_nama}}</p></td>
                </tr>
                <tr>
                    <td><p>Alamat</p></td>
                    <td><p>:</p></td>
                    <td><p class="data">{{$homeVisit->siswa->siswa_alamat}}</p></td>
                </tr>
            </table>
            <p>Menerangkan bahwa kami telah menerima Guru BK/ Wali Kelas dari SMK Negeri 5 Surabaya :</p>
            <table>
                @foreach ($homeVisit->guru as $guru)
                    <tr>
                        <td style="width: 125px"><p>{{$loop->iteration}}. Nama</p></td>
                        <td style="width: 13px"><p>:</p></td>
                        <td><p class="data">{{$guru["'nama'"]}}</p></td>
                    </tr>
                    <tr>
                        <td style="width: 125px"><p>Jabatan</p></td>
                        <td style="width: 13px"><p>:</p></td>
                        <td><p class="data">{{$guru["'jabatan'"]}}</p></td>
                    </tr>
                @endforeach
            </table>
            <p style="line-height: 25px">Adapun masalah - masalah yang dihadapi anak kami sehingga anak kami tidak masuk
                sebagai berikut <span class="underline">{{$homeVisit->permasalahan_siswa}}.</span></p>
            <p>Maka demi suksesnya pendidikan anak kami, langkah yang akan kami tempuh sebagai berikut</p>
            <p style="line-height: 25px" class="underline">{{$homeVisit->langkah}}</p>
            <p>Demikian agar menjadikan maklum adanya.</p>
            <table>
                <tr>
                    <td></td>
                    <td><p style="text-align: right;margin-right: 50px">Surabaya, <span class="underline">&nbsp;&nbsp;&nbsp;{{date('d F Y')}}&nbsp;&nbsp;&nbsp;&nbsp;</span></p></td>
                </tr>
                <tr style="text-align: center">
                    <td><p>Guru BK/Wali Kelas</p></td>
                    <td><p>Orangtua/Wali murid</p></td>
                </tr>
                <tr style="text-align: center;">
                    <td><p class="signature"></p></td>
                    <td><p class="signature"></p></td>
                </tr>
                <tr>
                    <td colspan="2"><p style="padding-left: 15px;margin-top: 0">NIP.</p></td>
                </tr>
            </table>
            <div style="text-align: center">
                <p>Mengetahui</p>
                <p>KEPALA SMKN 5 SURABAYA</p>
                <br><br>
                <p class="underline">Drs. HERU MURSANYOTO, M.M</p>
                <p>Pembina Tk. I</p>
                <p>NIP. 19630913 198703 1 016</p>
            </div>
        </div>
    </div>
    <div class="pagebreak"></div>
    <style>
        .data2{
            display: inline-block;
            width: 60%;
            border-bottom: 1px dotted black;
        }
        .info-siswa2 p{
            margin: 0
        }
        h4{
            font-family: serif;
        }
    </style>
    <div class="header">
        <div class="title text-center">
            <h3>CATATAN HOME VISIT</h3>
        </div>
        <div class="content">
            <table class="info-siswa2">
                <tr>
                    <td style="width: 100px"><p>NAMA</p></td>
                    <td style="width: 8px"><p>:</p></td>
                    <td><p class="data2">{{$homeVisit->siswa->siswa_nama}}</p></td>
                </tr>
                <tr>
                    <td><p>KELAS</p></td>
                    <td><p>:</p></td>
                    <td><p class="data2">{{$homeVisit->siswa->kelas->kelasjurusan_nama}}</p></td>
                </tr>
                <tr>
                    <td><p>NO. ABS</p></td>
                    <td><p>:</p></td>
                    <td><p class="data2">{{$homeVisit->siswa->no_absen??1}}</p></td>
                </tr>
            </table>
            <h4>PERMASALAHAN SISWA :</h4>
            <p class="masalah underline" style="width: 80%">{{$homeVisit->permasalahan_siswa}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <h4>LATAR BELAKANG PERMASALAHAN :</h4>
            <p class="masalah underline">{{$homeVisit->latar_belakang}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <h4>SARAN GURU BK/WALIKELAS :</h4>
            <p class="masalah underline">{{$homeVisit->saran_guru}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <h4>HARAPAN ORANG TUA :</h4>
            <p class="masalah underline">{{$homeVisit->harapan_ortu}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <table>
                <tr>
                    <td></td>
                    <td><p style="text-align: right;margin-right: 50px">Surabaya, <span class="underline">&nbsp;&nbsp;&nbsp;{{date('d F Y')}}&nbsp;&nbsp;&nbsp;&nbsp;</span></p></td>
                </tr>
                <tr style="text-align: center">
                    <td><p>Orangtua/Wali Siswa</p></td>
                    <td><p>Guru BK / Walikelas</p></td>
                </tr>
                <tr style="text-align: center;">
                    <td><p style="margin-top: 70px">
                        (
                            @for ($i = 0; $i < 14; $i++)
                                &nbsp;&nbsp;
                            @endfor
                        )
                    </p></td>
                    <td><p style="margin-top: 70px">
                        (
                            @for ($i = 0; $i < 14; $i++)
                                &nbsp;&nbsp;
                            @endfor
                        )
                    </p></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

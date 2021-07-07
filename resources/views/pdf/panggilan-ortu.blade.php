@extends('layouts.pdf')

@section('style')
    <style>
        p{
            line-height: 25px;
        }
        .tab{
            padding-left: 50px;
        }
        .info tr td p{
            line-height: 16px;
        }
    </style>
@endsection

@section('content')
    <br><br>
    <div class="content">
        <hr style="border-bottom: 2px solid black;">
        <table style="margin-top: 35px">
            <tr>
                <td><p>Perihal : {{$panggilanOrtu->perihal}}</p></td>
                <td style="text-align: right"><p>Surabaya : {{tanggal(date('d-m-Y'),'%d %B %Y')}}</p></td>
            </tr>
        </table>
        <p>Kepada</p>
        <p class="tab">Yth Bapak/Ibu Orang Tua/Wali Siswa</p>
        <p class="tab">{{$panggilanOrtu->siswa->siswa_nama}}</p>
        <p class="tab">{{$panggilanOrtu->siswa->kelas->kelasjurusan_nama}}</p>
        <p class="tab">Di Tempat</p>
        <br>
        <p>Dengan Hormat,</p>
        <p>Sehubungan dengan adanya sesuatu yang perlu disampaikan kepada Bapak/Ibu, maka Kami
            mengundang Bapak/Ibu untuk hadir pada:</p>
        <table class="info">
            <tr>
                <td style="width: 100px"><p>Hari</p></td>
                <td style="width: 11px"><p>:</p></td>
                <td><p>{{tanggal($panggilanOrtu->tanggal_panggilan, '%A')}}</p></td>
            </tr>
            <tr>
                <td><p>Tanggal</p></td>
                <td><p>:</p></td>
                <td><p>{{tanggal($panggilanOrtu->tanggal_panggilan, '%d %B %Y')}}</p></td>
            </tr>
            <tr>
                <td><p>Jam</p></td>
                <td><p>:</p></td>
                <td><p>{{str_replace(':','.',$panggilanOrtu->pukul)}} - Selesai</p></td>
            </tr>
            <tr>
                <td><p>Tempat</p></td>
                <td><p>:</p></td>
                <td><p>{{$panggilanOrtu->tempat}}</p></td>
            </tr>
        </table><br>
        <p>Mengingat sangat pentingnya hal di atas dimohon Bapak/Ibu untuk besedia hadir tepat waktu. Atas
            perhatian dan kehadirannya Kami ucapkan terimakasih.</p><br>
        <table>
            <tr>
                <td rowspan="4" style="width: 60%">&nbsp;</td>
                <td><p>Guru BK/Wali Kelas</p></td>
            </tr>
            <tr>
                <td style="height: 100px">&nbsp;</td>
            </tr>
            <tr>
                <td><p class="underline" style="margin: 0">{{$panggilanOrtu->guruBk->gelar_depan.' '.$panggilanOrtu->guruBk->name.' '.$panggilanOrtu->guruBk->gelar_belakang}}</p><p>NIP. {{$panggilanOrtu->guruBk->nim}}</p></td>
            </tr>
        </table>
    </div>
@endsection

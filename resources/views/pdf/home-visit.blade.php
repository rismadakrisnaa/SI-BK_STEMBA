@extends('layouts.pdf')

@section('content')
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
                <td><p style="text-align: right;margin-right: 50px">Surabaya, <span class="underline">&nbsp;&nbsp;&nbsp;{{tanggal(date('d-m-Y'),'%d %B %Y')}}&nbsp;&nbsp;&nbsp;&nbsp;</span></p></td>
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
                <td><p style="text-align: right;margin-right: 50px">Surabaya, <span class="underline">&nbsp;&nbsp;&nbsp;{{tanggal(date('d-m-Y'),'%d %B %Y')}}&nbsp;&nbsp;&nbsp;&nbsp;</span></p></td>
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
@endsection

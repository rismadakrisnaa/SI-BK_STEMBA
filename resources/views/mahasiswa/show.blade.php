@extends('layouts.app')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0">Detail Mahasiswa</h1>
    <a href="{{ url('/dashboard/mahasiswa') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<table class="table table-striped">
    <tr>
        <th style="width: 200px;">ID</th>
        <td>{{ $row->_id }}</td>
    </tr>
    <tr>
        <th>NIM</th>
        <td>{{ $row->mhsw_nim }}</td>
    </tr>
    <tr>
        <th>NAMA</th>
        <td>{{ $row->mhsw_nama }}</td>
    </tr>
    <tr>
        <th>JENIS KELAMIN</th>
        <td>{{ $row->mhsw_jk }}</td>
    </tr>
    <tr>
        <th>TEMPAT LAHIR</th>
        <td>{{ $row->mhsw_tmplahir }}</td>
    </tr>
    <tr>
        <th>TANGGAL LAHIR</th>
        <td>{{ \Carbon\Carbon::parse($row->mhsw_tgllahir)->formatLocalized('%d %B %Y') }}</td>
    </tr>
    <tr>
        <th>ALAMAT</th>
        <td>{{ $row->mhsw_alamat }}</td>
    </tr>
    <tr>
        <th>HP</th>
        <td>{{ $row->mhsw_hp }}</td>
    </tr>
    <tr>
        <th>PRODI</th>
        <td>{{ $row->prodi['prodi_nama'] }} (<span class="font-weight-bold">{{ $row->prodi['prodi_kode'] }}</span>)</td>
    </tr>
    <tr>
        <th>PEMBIMBING AKADEMIK</th>
        <td>{{ !empty($row->dosen['dsn_gelar_depan']) ? $row->dosen['dsn_gelar_depan'] . '. ' : '' }}
            {{ $row->dosen['dsn_nama'] }}{{ !empty($row->dosen['dsn_gelar_belakang']) ? ', ' . $row->dosen['dsn_gelar_belakang'] : '' }}
        </td>
    </tr>
    <tr>
        <th>DIBUAT</th>
        <td>{{ \Carbon\Carbon::parse($row->created_at)->formatLocalized('%d %B %Y %H:%M:%S') }}</td>
    </tr>
    <tr>
        <th>DIEDIT</th>
        <td>{{ $row->updated_at != '' ? \Carbon\Carbon::parse($row->updated_at)->formatLocalized('%d %B %Y %H:%M:%S') : '' }}
        </td>
    </tr>
</table>

@endsection

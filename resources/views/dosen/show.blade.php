@extends('layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0">Detail Dosen</h1>
        <a href="{{ url('/dashboard/dosen') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <table class="table table-striped">
        <tr>
            <th style="width: 200px;">ID</th>
            <td>{{ $row->_id }}</td>
        </tr>
        <tr>
            <th>NIP</th>
            <td>{{ $row->dsn_nip }}</td>
        </tr>
        <tr>
            <th>NIDN</th>
            <td>{{ $row->dsn_nidn }}</td>
        </tr>
        <tr>
            <th>NAMA</th>
            <td>{{ $row->dsn_nama }}</td>
        </tr>
        <tr>
            <th>GELAR DEPAN</th>
            <td>{{ $row->dsn_gelar_depan }}</td>
        </tr>
        <tr>
            <th>GELAR BELAKANG</th>
            <td>{{ $row->dsn_gelar_belakang }}</td>
        </tr>
        <tr>
            <th>PROGRAM STUDI</th>
            <td>{{ $row->prodi['prodi_nama'] }} (<span class="font-weight-bold">{{ $row->prodi['prodi_kode'] }}</span>)</td>
        </tr>
        <tr>
            <th>FAKULTAS</th>
            <td><span class="font-weight-bold">{{ $row->fakultas['fak_kode'] }}</span> -
                {{ $row->fakultas['fak_nama'] }}</td>
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

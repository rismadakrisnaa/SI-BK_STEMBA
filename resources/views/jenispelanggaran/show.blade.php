@extends('layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0">Detail Jenis Pelanggaran</h1>
        <a href="{{ url('/dashboard/jenispelanggaran') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <table class="table table-striped">
        <tr>
            <th style="width: 200px;">ID</th>
            <td>{{ $row->_id }}</td>
        </tr>
        <tr>
            <th>KODE</th>
            <td><span class="font-weight-bold">{{ $row->jenispelanggaran_kode }}</span></td>
        </tr>
        <tr>
            <th>NAMA</th>
            <td>{{ $row->jenispelanggaran_nama }}</td>
        </tr>
        <tr>
            <th>POIN</th>
            <td>{{ $row->jenispelanggaran_poin }}</span></td>
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

@push('js')
    <script>
        $('#collapseFive').addClass('show').parent().addClass('active');
        $('#jenis-pelanggaran').addClass('active');
    </script>
@endpush

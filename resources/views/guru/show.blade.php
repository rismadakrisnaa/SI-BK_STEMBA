@extends('layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0">Detail Guru</h1>
        <a href="{{ url('/dashboard/guru') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <table class="table table-striped">
        <tr>
            <th style="width: 200px;">ID</th>
            <td>{{ $row->_id }}</td>
        </tr>
        <tr>
            <th>NIP</th>
            <td>{{ $row->guru_nip }}</td>
        </tr>
        <tr>
            <th>NUPTK</th>
            <td>{{ $row->guru_nidn }}</td>
        </tr>
        <tr>
            <th>NAMA</th>
            <td>{{ $row->guru_nama }}</td>
        </tr>
        <tr>
            <th>GELAR DEPAN</th>
            <td>{{ $row->guru_gelar_depan }}</td>
        </tr>
        <tr>
            <th>GELAR BELAKANG</th>
            <td>{{ $row->guru_gelar_belakang }}</td>
        </tr>
        <tr>
            <th>NO TELEPON</th>
            <td>{{ $row->no_telepon }}</td>
        </tr>
        <tr>
            <th>EMAIL</th>
            <td>{{ $row->email }}</td>
        </tr>
        <tr>
            <th>JENIS KELAMIN</th>
            <td>{{ $row->guru_jk }}</td>
        </tr>
        <tr>
            <th>MENGAJAR MAPEL</th>
            <td>{{ $row->mengajar_mapel }}</td>
        </tr>
        {{-- <tr>
            <th>KELAS DAN JURUSAN</th>
            <td>{{ $row->kelasjurusan['kelasjurusan_nama'] }} (<span class="font-weight-bold">{{ $row->kelasjurusan['kelasjurusan_kode'] }}</span>)</td>
        </tr> --}}

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
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#guru').addClass('active');
    </script>
@endpush

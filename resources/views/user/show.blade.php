@extends('layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0">Detail User</h1>
        <a href="{{ url('/dashboard/user') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <table class="table table-striped">
        <tr>
            <th style="width: 200px;">ID</th>
            <td>{{ $row->_id }}</td>
        </tr>
        <tr>
            <th>NAMA LENGKAP</th>
            <td>{{ $row->name }}</td>
        </tr>
        <tr>
            <th>EMAIL</th>
            <td>{{ $row->email }}</td>
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

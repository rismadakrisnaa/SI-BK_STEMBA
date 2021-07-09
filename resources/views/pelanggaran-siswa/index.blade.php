@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Pelanggaran Siswa</h1>
        @canany(['admin','gurubk'])
        <a href="{{route('pelanggaran-siswa.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
        </a>
        @endcanany
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @endif
    @endforeach

    @include('layouts.includes.errors')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pelanggaran Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group row no-gutters">
                                <label for="kelas_id" class="col-3">Kelas</label>
                                <span class="col-1 text-center">:</span>
                                <div class="col-8">
                                    <select id="kelas_id" class="custom-select custom-select-sm"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group row no-gutters">
                                <label for="order_by" class="col-3">Filter</label>
                                <span class="col-1 text-center">:</span>
                                <div class="col-8">
                                    <select id="order_by" class="custom-select custom-select-sm">
                                        <option value="default">Semua</option>
                                        <option value="desc">Menurun</option>
                                        <option value="asc">Menaik</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="pelanggaranTable">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Poin Pelanggaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('js/view/pelanggaran-siswa.js')}}"></script>
@endpush

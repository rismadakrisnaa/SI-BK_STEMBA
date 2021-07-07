@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Jenis Pelanggaran</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Jenis Pelanggaran</h6>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ url('/dashboard/jenispelanggaran') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">KODE</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('jenispelanggaran_kode')is-invalid @enderror" type="text"
                                    name="jenispelanggaran_kode" placeholder="Kode Riwayat Pelanggaran" required="" autofocus="">

                                @error('jenispelanggaran_kode')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('jenispelanggaran_nama')is-invalid @enderror" type="text"
                                    name="jenispelanggaran_nama" placeholder="Nama Jenis Pelanggaran" required="">

                                @error('jenispelanggaran_nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">POIN</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('jenispelanggaran_poin')is-invalid @enderror" type="integer"
                                    name="jenispelanggaran_poin" placeholder="Poin Pelanggaran" required="" autofocus="">

                                @error('jenispelanggaran_poin')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/jenispelanggaran') }}" class="btn btn-primary">
                                <i class="fa fa-arrow-left mr-2"></i> KEMBALI
                            </a>
                            <button class="btn btn-success" type="submit" name="input">
                                <i class="fa fa-save mr-2"></i> SIMPAN
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $('#collapseFive').addClass('show').parent().addClass('active');
        $('#jenis-pelanggaran').addClass('active');
    </script>
@endpush

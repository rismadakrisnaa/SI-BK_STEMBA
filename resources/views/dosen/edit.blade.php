@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Fakultas</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Fakultas</h6>
                </div>
                <div class="card-body">

                    <form action="{{ url('/dashboard/fakultas/' . $row->_id) }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">KODE</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('fak_kode')is-invalid @enderror" type="text"
                                    name="fak_kode" value="{{ $row->fak_kode }}" placeholder="Kode Fakultas" required="" autofocus="">

                                @error('fak_kode')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('fak_nama')is-invalid @enderror" type="text"
                                    name="fak_nama" value="{{ $row->fak_nama }}" placeholder="Nama Fakultas" required="">

                                @error('fak_nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/fakultas') }}" class="btn btn-primary">
                                <i class="fa fa-arrow-left mr-2"></i> KEMBALI
                            </a>
                            <button class="btn btn-success" type="submit" name="input">
                                <i class="fa fa-save mr-2"></i> UPDATE
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

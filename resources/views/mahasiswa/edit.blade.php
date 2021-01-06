@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Mahasiswa</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Mahasiswa</h6>
                </div>
                <div class="card-body">

                    <form action="{{ url('/dashboard/mahasiswa/' . $row->_id) }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">NIM</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="mhsw_nim" value="{{ $row->mhsw_nim }}"
                                    placeholder="Nomor Induk Mahasiswa" required="" autofocus="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="mhsw_nama" value="{{ $row->mhsw_nama }}"
                                    placeholder="Nama" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">ALAMAT</label>
                            <div class="col-sm-10">
                                <textarea rows="3" class="form-control" name="mhsw_alamat"
                                    placeholder="Alamat Lengkap">{{ $row->mhsw_alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">PROGRAM STUDI</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="mhsw_prodi" value="{{ $row->mhsw_prodi }}"
                                    placeholder="Program Studi">
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/mahasiswa') }}" class="btn btn-primary">
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

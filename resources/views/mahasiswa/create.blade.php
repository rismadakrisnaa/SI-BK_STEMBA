@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Mahasiswa</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Mahasiswa</h6>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ url('/dashboard/mahasiswa') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">NIM</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('mhsw_nim')is-invalid @enderror" type="text"
                                    name="mhsw_nim" placeholder="Nomor Induk Mahasiswa" required="" autofocus="">

                                @error('mhsw_nim')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="mhsw_nama" placeholder="Nama" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">JENIS KELAMIN</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mhsw_jk" value="Laki-laki" id="jk1"
                                        checked>
                                    <label class="form-check-label" for="jk1">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mhsw_jk" value="Perempuan" id="jk2">
                                    <label class="form-check-label" for="jk2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">TEMPAT LAHIR</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="mhsw_tmplahir" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">TANGGAL LAHIR</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="date" name="mhsw_tgllahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">ALAMAT</label>
                            <div class="col-sm-10">
                                <textarea rows="3" class="form-control" name="mhsw_alamat"
                                    placeholder="Alamat Lengkap"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">HP</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="mhsw_hp" placeholder="Nomor HP">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">PROGRAM STUDI</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="prodi">
                                    <option>Default select</option>
                                  </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">PEMBIMBING AKADEMIK</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="dosen">
                                    <option>Default select</option>
                                  </select>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/mahasiswa') }}" class="btn btn-primary">
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

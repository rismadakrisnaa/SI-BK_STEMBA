@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Siswa</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Siswa</h6>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ url('/dashboard/siswa') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">NIM</label>
                            <div class="col-sm-5">
                                <input class="form-control @error('siswa_nim')is-invalid @enderror" type="text"
                                    name="siswa_nim" placeholder="Nomor Induk Siswa" required="" autofocus="">

                                @error('siswa_nim')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="siswa_nama" placeholder="Nama" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">JENIS KELAMIN</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="siswa_jk" value="Laki-laki" id="jk1"
                                        checked>
                                    <label class="form-check-label" for="jk1">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="siswa_jk" value="Perempuan" id="jk2">
                                    <label class="form-check-label" for="jk2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">TEMPAT LAHIR</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="siswa_tmplahir" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">TANGGAL LAHIR</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="date" name="siswa_tgllahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">ALAMAT</label>
                            <div class="col-sm-10">
                                <textarea rows="3" class="form-control" name="siswa_alamat"
                                    placeholder="Alamat Lengkap"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">HP</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="siswa_hp" placeholder="Nomor HP">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">KELAS</label>
                            <div class="col-sm-7">
                                @if (count($col_kelasjurusan))
                                    <select class="form-control @error('kelasjurusan_kode')is-invalid @enderror" name="kelasjurusan_kode">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($col_kelasjurusan as $kelasjurusan)                                            
                                            <option value="{{ $kelasjurusan->kelasjurusan_kode }}">{{ $kelasjurusan->kelasjurusan_kode }} - {{ $kelasjurusan->kelasjurusan_nama }} ({{ $kelasjurusan->kelasjurusan_kode }})</option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="text-danger">Kelas tidak ditemukan</div>
                                @endif

                                @error('kelasjurusan_kode')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">WALI KELAS</label>
                            <div class="col-sm-7">
                                @if (count($col_guru))
                                    <select class="form-control @error('guru_nidn')is-invalid @enderror" name="guru_nidn">
                                        <option value="">-- Pilih Wali Kelas --</option>
                                        @foreach ($col_guru as $guru)
                                            <option value="{{ $guru->guru_nidn }}">{{ $guru->kelasjurusan['kelasjurusan_kode'] }} - {{ $guru->guru_nama }} ({{ $guru->guru_nidn }})</option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="text-danger">Guru atau Wali Kelas tidak ditemukan</div>
                                @endif

                                @error('guru_nidn')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/siswa') }}" class="btn btn-primary">
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

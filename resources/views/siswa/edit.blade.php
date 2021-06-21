@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Siswa</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Siswa</h6>
                </div>
                <div class="card-body">

                    <form action="{{ url('/dashboard/siswa/' . $row->_id) }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">NIM</label>
                            <div class="col-sm-5">
                                <input class="form-control @error('siswa_nim')is-invalid @enderror" type="text"
                                    name="siswa_nim" value="{{ $row->siswa_nim }}" placeholder="Nomor Induk Siswa" required="" autofocus="">

                                @error('siswa_nim')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="siswa_nama" value="{{ $row->siswa_nama }}" placeholder="Nama" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">JENIS KELAMIN</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="siswa_jk" value="Laki-laki" id="jk1"
                                    {{ $row->siswa_jk == 'Laki-laki' ? ' checked' : '' }}>
                                    <label class="form-check-label" for="jk1">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="siswa_jk" value="Perempuan" id="jk2"
                                    {{ $row->siswa_jk == 'Perempuan' ? ' checked' : '' }}>
                                    <label class="form-check-label" for="jk2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">TEMPAT LAHIR</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="siswa_tmplahir" value="{{ $row->siswa_tmplahir }}" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">TANGGAL LAHIR</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="date" name="siswa_tgllahir" value="{{ $row->siswa_tgllahir }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">ALAMAT</label>
                            <div class="col-sm-10">
                                <textarea rows="3" class="form-control" name="siswa_alamat"
                                    placeholder="Alamat Lengkap">{{ $row->siswa_alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">HP</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="siswa_hp" value="{{ $row->siswa_hp }}" placeholder="Nomor HP">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Kelas</label>
                            <div class="col-sm-7">
                                @if (count($col_guru))
                                    <select class="form-control" name="kelasjurusan_kode">
                                        @foreach ($col_kelasjurusan as $kelasjurusan)
                                            <option value="{{ $kelasjurusan->kelasjurusan_kode }}"{{ $kelasjurusan->kelasjurusan_kode == $row->kelasjurusan['kelasjurusan_kode'] ? ' selected' : '' }}>
                                                {{ $kelasjurusan->kelasjurusan_kode }} - {{ $kelasjurusan->kelasjurusan_nama }} ({{ $kelasjurusan->kelasjurusan_kode }})
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="text-danger">Kelas tidak ditemukan</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Wali Kelas</label>
                            <div class="col-sm-7">
                                @if (count($col_guru))
                                    <select class="form-control" name="guru_nidn">
                                        @foreach ($col_guru as $guru)
                                            <option value="{{ $guru->guru_nidn }}"{{ $guru->guru_nidn == $row->guru['guru_nidn'] ? ' selected' : '' }}>
                                                {{ $guru->kelasjurusan['kelasjurusan_kode'] }} - {{ $guru->guru_nama }} ({{ $guru->guru_nidn }})
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="text-danger">Guru tidak ditemukan</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">AKTIF</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="siswa_aktif" value="1" id="aktif1"
                                        {{ $row->siswa_aktif == 1 ? ' checked' : '' }}>
                                    <label class="form-check-label" for="aktif2">
                                        Aktif
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="siswa_aktif" value="0" id="aktif2"
                                    {{ $row->siswa_aktif == 0 ? ' checked' : '' }}>
                                    <label class="form-check-label" for="aktif2">
                                        Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/siswa') }}" class="btn btn-primary">
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

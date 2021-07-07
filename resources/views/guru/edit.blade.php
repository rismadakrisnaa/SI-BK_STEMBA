@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Guru</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Guru</h6>
                </div>
                <div class="card-body">

                    <form action="{{ url('/dashboard/guru/' . $row->_id) }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">NIP</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="text"
                                    name="guru_nip" value="{{ $row->guru_nip }}" placeholder="Nomor Induk Pegawai" autofocus="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NIDN</label>
                            <div class="col-sm-6">
                                <input class="form-control @error('guru_nidn')is-invalid @enderror" type="text"
                                    name="guru_nidn" value="{{ $row->guru_nidn }}" placeholder="Nomor Induk Guru Nasional" required="">

                                @error('guru_nidn')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('guru_nama')is-invalid @enderror" type="text"
                                    name="guru_nama" value="{{ $row->guru_nama }}" placeholder="Nama Lengkap" required="">

                                @error('guru_nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">GELAR DEPAN</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text"
                                    name="guru_gelar_depan" value="{{ $row->guru_gelar_depan }}" placeholder="Gelar Depan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">GELAR BELAKANG</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="text"
                                    name="guru_gelar_belakang" value="{{ $row->guru_gelar_belakang }}" placeholder="Gelar Belakang">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-sm-2">KELAS DAN JURUSAN</label>
                            <div class="col-sm-7">
                                @if (count($col_kelasjurusan))
                                    <select class="form-control" name="kelasjurusan_kode">
                                        @foreach ($col_kelasjurusan as $kelasjurusan)
                                            <option value="{{ $kelasjurusan->kelasjurusan_kode }}" {{ $kelasjurusan->kelasjurusan_kode == $row->kelasjurusan['kelasjurusan_kode'] ? 'selected' : '' }}>
                                                {{ $kelasjurusan->kelasjurusan_kode }} - {{ $kelasjurusan->kelasjurusan_nama }} ({{ $kelasjurusan->kelasjurusan_kode }})
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="text-danger">Kelas dan Jurusan tidak ditemukan</div>
                                @endif
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-sm-2">AKTIF</label>
                            <div class="col-sm-10">
                                @php $checked1 = $row->guru_aktif == 1 ? ' checked' : '' @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="guru_aktif" value="1" id="aktif1"
                                        {{ $checked1 }}>
                                    <label class="form-check-label" for="aktif2">
                                        Aktif
                                    </label>
                                </div>
                                @php $checked2 = $row->guru_aktif == 0 ? ' checked' : '' @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="guru_aktif" value="0" id="aktif2"
                                        {{ $checked2 }}>
                                    <label class="form-check-label" for="aktif2">
                                        Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/guru') }}" class="btn btn-primary">
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

@push('js')
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#guru').addClass('active');
    </script>
@endpush

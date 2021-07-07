@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Program Studi</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Program Studi</h6>
                </div>
                <div class="card-body">

                    <form action="{{ url('/dashboard/kelasjurusan/' . $row->_id) }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">WALI KELAS</label>
                            <div class="col-sm-10">
                                @if (count($col_guru))
                                    <select class="form-control" name="guru_nip">
                                        @foreach ($col_guru as $guru)
                                            <option value="{{ $guru->guru_nip }}" {{ $selected = $guru->guru_nip == $row->guru_nip ? 'selected' : '' }}>
                                                {{ $guru->guru_nip }} - {{ $guru->guru_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="text-danger">Wali Kelas tidak ditemukan</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">KODE</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('kelasjurusan_kode')is-invalid @enderror" type="text"
                                    name="kelasjurusan_kode" value="{{ $row->kelasjurusan_kode }}" placeholder="Kode Program Studi"
                                    required="" autofocus="">

                                @error('kelasjurusan_kode')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('kelasjurusan_nama')is-invalid @enderror" type="text"
                                    name="kelasjurusan_nama" value="{{ $row->kelasjurusan_nama }}" placeholder="Nama Program Studi"
                                    required="">

                                @error('kelasjurusan_nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-sm-2">AKREDITASI</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="kelasjurusan_akreditasi"
                                    value="{{ $row->kelasjurusan_akreditasi }}" placeholder="Akreditasi" required="">
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-sm-2">AKTIF</label>
                            <div class="col-sm-10">
                                @php $checked1 = $row->kelasjurusan_aktif == 1 ? ' checked' : '' @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kelasjurusan_aktif" value="1" id="aktif1"
                                        {{ $checked1 }}>
                                    <label class="form-check-label" for="aktif2">
                                        Aktif
                                    </label>
                                </div>
                                @php $checked2 = $row->kelasjurusan_aktif == 0 ? ' checked' : '' @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kelasjurusan_aktif" value="0" id="aktif2"
                                        {{ $checked2 }}>
                                    <label class="form-check-label" for="aktif2">
                                        Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/kelasjurusan') }}" class="btn btn-primary">
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
        $('#data-kelas').addClass('active');
    </script>
@endpush

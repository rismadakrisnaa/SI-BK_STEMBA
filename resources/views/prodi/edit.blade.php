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

                    <form action="{{ url('/dashboard/prodi/' . $row->_id) }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">FAKULTAS</label>
                            <div class="col-sm-10">
                                @if (count($col_fakultas))
                                    <select class="form-control" name="fak_kode">
                                        @foreach ($col_fakultas as $fak)
                                            <option value="{{ $fak->fak_kode }}" {{ $selected = $fak->fak_kode == $row->fakultas['fak_kode'] ? 'selected' : '' }}>
                                                {{ $fak->fak_kode }} - {{ $fak->fak_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="text-danger">Fakultas tidak ditemukan</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">KODE</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('prodi_kode')is-invalid @enderror" type="text"
                                    name="prodi_kode" value="{{ $row->prodi_kode }}" placeholder="Kode Program Studi"
                                    required="" autofocus="">

                                @error('prodi_kode')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('prodi_nama')is-invalid @enderror" type="text"
                                    name="prodi_nama" value="{{ $row->prodi_nama }}" placeholder="Nama Program Studi"
                                    required="">

                                @error('prodi_nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">AKREDITASI</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="prodi_akreditasi"
                                    value="{{ $row->prodi_akreditasi }}" placeholder="Akreditasi" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">AKTIF</label>
                            <div class="col-sm-10">
                                @php $checked1 = $row->prodi_aktif == 1 ? ' checked' : '' @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="prodi_aktif" value="1" id="aktif1"
                                        {{ $checked1 }}>
                                    <label class="form-check-label" for="aktif2">
                                        Aktif
                                    </label>
                                </div>
                                @php $checked2 = $row->prodi_aktif == 0 ? ' checked' : '' @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="prodi_aktif" value="0" id="aktif2"
                                        {{ $checked2 }}>
                                    <label class="form-check-label" for="aktif2">
                                        Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/prodi') }}" class="btn btn-primary">
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
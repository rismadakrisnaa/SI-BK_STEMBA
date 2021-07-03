@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Detail Pelanggaran Siswa</h1>
        <a href="{{route('pelanggaran-siswa.index')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Kembali
        </a>
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
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Pelanggaran Siswa</h6>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <td>{{$pelanggaranSiswa->_id}}</td>
                        </tr>
                        <tr>
                            <th>NAMA SISWA</th>
                            <td>{{$pelanggaranSiswa->siswa->siswa_nama}}</td>
                        </tr>
                        <tr>
                            <th>KELAS</th>
                            <td>{{$pelanggaranSiswa->siswa->kelas->kelasjurusan_nama}}</td>
                        </tr>
                        <tr>
                            <th>JENIS PELANGGARAN</th>
                            <td>{{$pelanggaranSiswa->pelanggaran->jenispelanggaran_nama}}</td>
                        </tr>
                        <tr>
                            <th>TOTAL POIN</th>
                            <td>{{$pelanggaranSiswa->point}}</td>
                        </tr>
                        <tr>
                            <th>BUKTI FOTO</th>
                            <td>
                                <img src="{{asset('images/bukti_foto').'/'.$pelanggaranSiswa->bukti_foto}}" width="541" alt="" srcset="">
                            </td>
                        </tr>
                        <tr>
                            <th>DIBUAT</th>
                            <td>{{$pelanggaranSiswa->created_at->format('d M Y H:i:s')}}</td>
                        </tr>
                        <tr>
                            <th>DIEDIT</th>
                            <td>{{$pelanggaranSiswa->updated_at->format('d M Y H:i:s')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('js/view/pelanggaran-siswa.js')}}"></script>
@endpush

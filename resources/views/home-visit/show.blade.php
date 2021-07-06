@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Detail Home Visit</h1>
        <a href="{{route('home-visit.index')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Home Visit</h6>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <td>{{$homeVisit->_id}}</td>
                        </tr>
                        <tr>
                            <th>NAMA SISWA</th>
                            <td>{{$homeVisit->siswa->siswa_nama}}</td>
                        </tr>
                        <tr>
                            <th>KELAS</th>
                            <td>{{$homeVisit->siswa->kelas->kelasjurusan_nama}}</td>
                        </tr>
                        <tr>
                            <th>PERMASALAHAN SISWA</th>
                            <td>{{$homeVisit->permasalahan_siswa}}</td>
                        </tr>
                        <tr>
                            <th>LANGKAH YANG DITEMPUH</th>
                            <td>{{$homeVisit->langkah}}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">GURU YANG TERKAIT</th>
                        </tr>
                        <tr class="text-center">
                            <th>NAMA GURU BK/WALI KELAS</th>
                            <th>JABATAN</th>
                        </tr>
                        @foreach ($homeVisit->guru as $guru)
                            <tr class="text-center">
                                <td>{{$guru["'nama'"]}}</td>
                                <td>{{$guru["'jabatan'"]}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th>LATAR BELAKANG PERMASALAHAN</th>
                            <td>{{$homeVisit->latar_belakang}}</td>
                        </tr>
                        <tr>
                            <th>SARAN DARI GURU BK/WALI KELAS</th>
                            <td>{{$homeVisit->saran_guru}} Poin</td>
                        </tr>
                        <tr>
                            <th>HARAPAN ORANG TUA</th>
                            <td>{{$homeVisit->harapan_ortu}}</td>
                        </tr>
                        <tr>
                            <th>SOLUSI YANG DIPUTUSKAN BERSAMA</th>
                            <td>{{$homeVisit->solusi}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th>DIBUAT</th>
                            <td>{{$homeVisit->created_at->format('d M Y H:i:s')}}</td>
                        </tr>
                        <tr>
                            <th>DIEDIT</th>
                            <td>{{$homeVisit->updated_at->format('d M Y H:i:s')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('js/view/home_visit.js')}}"></script>
@endpush

@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Detail Panggilan Orang Tua</h1>
        <a href="{{route('panggilan-ortu.index')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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

    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Panggilan Orang Tua</h6>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <td>{{$panggilanOrtu->_id}}</td>
                        </tr>
                        <tr>
                            <th>NAMA SISWA</th>
                            <td>{{$panggilanOrtu->siswa->siswa_nama}}</td>
                        </tr>
                        <tr>
                            <th>KELAS</th>
                            <td>{{$panggilanOrtu->siswa->kelas->kelasjurusan_nama}}</td>
                        </tr>
                        <tr>
                            <th>PERIHAL</th>
                            <td>{{$panggilanOrtu->perihal}}</td>
                        </tr>
                        <tr>
                            <th>TANGGAL PANGGILAN</th>
                            <td>{{$panggilanOrtu->tanggal_panggilan}}</td>
                        </tr>
                        <tr>
                            <th>PUKUL</th>
                            <td>{{$panggilanOrtu->pukul}}</td>
                        </tr>
                        <tr>
                            <th>TEMPAT</th>
                            <td>{{$panggilanOrtu->tempat}}</td>
                        </tr>
                        <tr>
                            <th>GURU BK</th>
                            <td>{{$panggilanOrtu->guruBk->name}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>DIBUAT</th>
                            <td>{{$panggilanOrtu->created_at->format('d M Y H:i:s')}}</td>
                        </tr>
                        <tr>
                            <th>DIEDIT</th>
                            <td>{{$panggilanOrtu->updated_at->format('d M Y H:i:s')}}</td>
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

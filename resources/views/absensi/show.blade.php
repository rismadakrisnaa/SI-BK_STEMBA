@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-0">
    <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Absensi Siswa Kelas {{$absensi->kelasjurusan_nama}}</h1>
    <a href="/dashboard/absensi" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>
<h3 class="h4 text-gray-800 mb-2 mb-lg-0">Tanggal {{date('d-m-Y')}}</h3>

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if (Session::has('alert-' . $msg))
        <div class="alert alert-{{ $msg }} alert-dismissible mt-2 fade show">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @endif
@endforeach

@include('layouts.includes.errors')

<div class="card mt-3">
    <form action="" method="post">
        @csrf
        @method('put')
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5px">NO</th>
                        <th>Nama</th>
                        <th>Absen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensi->siswa->sortBy('siswa_nama') as $siswa)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <label for="siswa-{{$siswa->_id}}"></label>
                                {{$siswa->siswa_nama}}
                            </td>
                            <td>
                                <select name="absen[{{$siswa->_id}}]" id="siswa-{{$siswa->_id}}" class="custom-select">
                                    <option value=""></option>
                                    @foreach ($absenan as $i => $absen)
                                    <option value="{{$i}}" {{($absenToday->isNotEmpty()&&($absenToday->where('siswa_id',$siswa->_id)->first()->absen??'')==$i)?'selected':''}}>{{$absen}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection

@push('js')
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active')
        $('#absensi').addClass('active')
    </script>
@endpush

@extends('layouts.app')

@section('content')
<div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
      @endif
    @endforeach

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas dan Jurusan</h6>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <h4>Tanggal : {{date('d-m-Y')}}</h4>
                    <div class="table-responsive" style="border-radius: 7px;">
                        <table class="table table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>NO</th>
                                    <th>KELAS DAN JURUSAN</th>
                                    <th>WALI KELAS</th>
                                    <th>TOTAL SISWA</th>
                                    <th>AKTIF</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $class)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$class->kelasjurusan_nama}}</td>
                                        <td>{{$class->guru['guru_nama']}}</td>
                                        <td class="pl-5 font-weight-bold">{{count($class->siswa)}}</td>
                                        <td>{{$class->kelasjurusan_aktif}}</td>
                                        <td>
                                            <a href="absensi/{{$class->kelasjurusan_kode}}" class="btn btn-sm btn-info">Absen</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('js')
    <script>
        $('#collapseTwo').addClass('show')
        $('#absensi').addClass('active')
    </script>
@endpush

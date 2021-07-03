@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Tambah Pelanggaran Siswa</h1>
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
        <div class="col-10">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Pelanggaran Siswa</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pelanggaran-siswa.update',$pelanggaranSiswa->_id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('pelanggaran-siswa._form')
                        <img src="{{asset('images/bukti_foto').'/'.$pelanggaranSiswa->bukti_foto}}" width="400px" alt="">
                        <div class="form-group float-right">
                            <a href="{{ route('pelanggaran-siswa.index') }}" class="btn btn-primary">
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

@push('js')
    <script src="{{asset('js/view/pelanggaran-siswa.js')}}"></script>
    <script>
        $.ajax({
            url: '',
            async: false,
            success: function(result){
                $('#kelas_id').val(result.kelas_id);
                var event = new Event('change');
                $('#kelas_id')[0].dispatchEvent(event);
                $('#siswa_id').val(result.siswa_id);
                $('#kelas_id').attr('disabled',true);
                $('#siswa_id').attr('disabled',true);
                $('#pelanggaran_id').val(result.pelanggaran_id);
                $('#pelanggaran_id')[0].dispatchEvent(event);
            }
        })
    </script>
@endpush

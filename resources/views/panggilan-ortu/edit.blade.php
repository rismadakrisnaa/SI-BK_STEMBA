@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Tambah Panggilan Orang Tua</h1>
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @endif
    @endforeach

    @include('layouts.includes.errors')

    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Panggilan Orang Tua</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('panggilan-ortu.update',$panggilanOrtu->_id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('panggilan-ortu._form')
                <div class="form-group float-right">
                    <a href="{{ route('panggilan-ortu.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left mr-2"></i> KEMBALI
                    </a>
                    <button class="btn btn-success" type="submit" name="input">
                        <i class="fa fa-save mr-2"></i> SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('js/view/panggilan-ortu.js')}}"></script>
    <script>
        $.ajax({
            url: '',
            async: false,
            success: function(result){
                $('#kelas_id').val(result.kelas_id);
                var event = new Event('change');
                $('#kelas_id')[0].dispatchEvent(event);
                for(index in result){
                    $('#'+index).val(result[index]);
                }
            }
        })
    </script>
@endpush

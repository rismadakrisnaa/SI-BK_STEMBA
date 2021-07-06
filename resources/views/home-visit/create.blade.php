@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Tambah Laporan Home Visit</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Form Surat Keterangan Home Visit</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('home-visit.store') }}" enctype="multipart/form-data">
                @csrf
                @include('home-visit._form')
                <div class="form-group float-right">
                    <a href="{{ route('home-visit.index') }}" class="btn btn-primary">
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
    <script src="{{asset('js/view/home_visit.js')}}"></script>
    <script>
        ['latar_belakang','saran_guru','harapan_ortu','solusi'].forEach(id=>{
            $('#'+id).attr('readonly',true);
        })
    </script>
@endpush

@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Guru</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Guru</h6>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ url('/dashboard/guru') }}">
                        @csrf
                        @include('guru._form')
                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/guru') }}" class="btn btn-primary">
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
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#guru').addClass('active');
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-0">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Timeline Akademik</h1>
        <a href="/dashboard/timeline-akademik/create" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Baru
        </a>
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible mt-2 fade show">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @endif
    @endforeach

    @include('layouts.includes.errors')

    @foreach ($timelines as $timeline)
        <div class="card">
            <div class="card-header">{{$timeline->judul}}</div>
            <div class="card-body">{!! $timeline->body !!}</div>
        </div>
    @endforeach

    @if ($timelines->isEmpty())
        <div class="alert alert-warning mt-4 text-center">Belum Ada Timeline Tersedia.</div>
    @endif

@endsection

@push('js')
    <script>
        $('#timeline-akademik').parent().addClass('active');
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-0">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Timeline Akademik</h1>
        @canany(['admin','gurubk'])
        <a href="/dashboard/timeline-akademik/create" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Baru
        </a>
        @endcanany
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible mt-2 fade show">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @endif
    @endforeach

    @include('layouts.includes.errors')

    @foreach ($timelines->sortByDesc('created_at') as $timeline)
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <span class="h2">{{$timeline->judul}}</span><br>
                    <span class="text-muted">Dibuat oleh <b class="text-info">{{$timeline->user->name??'Tidak diketahui'}}</b> tanggal <b class="text-info">{{date('d M Y', strtotime($timeline->created_at))}}</b></span>
                </div>
                @if ($timeline->user_id==auth()->user()->_id)
                <div class="d-flex justify-content-between" style="height: 100%">
                    <a href="{{route('timeline-akademik.edit',$timeline->_id)}}" class="btn btn-sm btn-warning mr-2">Edit</a>
                    <form action="{{route('timeline-akademik.destroy',$timeline->_id)}}" method="post">
                        @csrf @method('delete')
                        <button class="btn btn-sm btn-danger delete-confirm">Delete</button>
                    </form>
                </div>
                @endif
            </div>
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
        $(document).on('click', '.delete-confirm', function(e) {
            e.preventDefault();
            var form = $(this).parent();
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Data ini akan dihapus secara permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus permanen!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        });

    </script>
@endpush

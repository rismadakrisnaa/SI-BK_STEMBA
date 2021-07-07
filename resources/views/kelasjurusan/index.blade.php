@extends('layouts.app')
@section('content')

@livewire('kelasjurusan-index')

@endsection

@push('js')
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#data-kelas').addClass('active');
    </script>
@endpush

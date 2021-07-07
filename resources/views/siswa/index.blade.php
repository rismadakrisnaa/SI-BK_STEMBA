@extends('layouts.app')
@section('content')

@livewire('siswa-index')

@endsection

@push('js')
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#data-siswa').addClass('active');
    </script>
@endpush

@extends('layouts.app')
@section('content')

@livewire('guru-index')

@endsection

@push('js')
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#guru').addClass('active');
    </script>
@endpush

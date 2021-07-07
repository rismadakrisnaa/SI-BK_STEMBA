@extends('layouts.app')
@section('content')

@livewire('jenispelanggaran-index')

@endsection

@push('js')
    <script>
        $('#collapseFive').addClass('show').parent().addClass('active');
        $('#jenis-pelanggaran').addClass('active');
    </script>
@endpush

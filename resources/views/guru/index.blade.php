@extends('layouts.app')
@section('content')

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if (Session::has('alert-' . $msg))
        <div class="alert alert-{{ $msg }} alert-dismissible fade show">
            {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @endif
@endforeach

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Guru</h1>
    <a href="{{ url('/dashboard/guru/create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
    </div>
    <div class="card-body">
        {{-- <div>
            <form action="{{route('guru.store-import')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="guruexcel">
                <input class="btn btn-success" type="submit" value="Import Data">
            </form>
        </div> --}}
        <div class="table-responsive">
            <table class="table myDataTable table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">NO</th>
                        <th>NIP</th>
                        <th>NUPTK</th>
                        <th>NAMA</th>
                        <th>AKTIF</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allGuru as $guru)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $guru->guru_nip }}</td>
                            <td>{{ $guru->guru_nidn }}</td>
                            <td>
                                {{ $guru->getFullName() }}
                            </td>
                            <td>
                                @if ($guru->guru_aktif==1)
                                    <div class="text-center"><i class="fa fa-check-double text-success"></i></div>
                                @else
                                    <div class="text-center"><i class="fa fa-times-circle text-danger"></i></div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex float-right">
                                    <a href="{{ url('/dashboard/guru/' . $guru->_id) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="fa fa-info-circle"></i>
                                        <span class="d-none d-lg-inline">DETAIL</span>
                                    </a>
                                    <a href="{{ url('/dashboard/guru/' . $guru->_id . '/edit') }}"
                                        class="btn btn-sm btn-warning ml-2">
                                        <i class="fa fa-edit"></i>
                                        <span class="d-none d-lg-inline">EDIT</span>
                                    </a>
                                    <form action="{{ url('/dashboard/guru/' . $guru->_id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm ml-2 delete-confirm">
                                            <i class="fa fa-trash"></i>
                                            <span class="d-none d-lg-inline">HAPUS</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@push('js')
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#guru').addClass('active');
        $(document).on('click', '.delete-confirm', function(e) {
            e.preventDefault();
            var form = $(this);
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

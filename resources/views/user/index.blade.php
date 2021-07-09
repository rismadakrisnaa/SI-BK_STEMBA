@extends('layouts.app')
@section('content')

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
    @endif
@endforeach

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">User</h1>
    <a href="{{ url('/dashboard/user/create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah User
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table myDataTable table-hover" data-form="dataForm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">NO</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role??'' }}</td>
                            <td>
                                <div class="d-flex float-right">
                                    <a href="{{ url('/dashboard/user/' . $user->_id) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="fa fa-info-circle"></i>
                                        <span class="d-none d-lg-inline">DETAIL</span>
                                    </a>
                                    <a href="{{ url('/dashboard/user/' . $user->_id . '/edit') }}"
                                        class="btn btn-sm btn-warning ml-2">
                                        <i class="fa fa-edit"></i>
                                        <span class="d-none d-lg-inline">EDIT</span>
                                    </a>
                                    <form action="{{ url('/dashboard/user/' . $user->_id) }}" method="POST"
                                        class="delete-confirm">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <button class="btn btn-danger btn-sm ml-2">
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
        $('table[data-form="dataForm"]').on('click', '.delete-confirm', function(e) {
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

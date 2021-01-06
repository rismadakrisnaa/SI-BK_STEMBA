<div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
      @endif
    @endforeach

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0">User</h1>
        <a href="{{ url('/dashboard/user/create') }}"
            class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col align-self-start form-inline mb-2 mb-lg-0">
                    Per Page : &nbsp;
                    <select wire:model="perPage" class="form-control">
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    </select>
                </div>

                <div class="col-lg-4 align-self-end">
                    <div class="input-group">
                        <input wire:model="search" class="form-control" type="text" placeholder="Search ...">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover" data-form="dataForm">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th></th>
                            </tr>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $rows->perPage() * ($rows->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        <div class="d-flex float-right">
                                            <a href="{{ url('/dashboard/user/' . $row->_id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa fa-info-circle"></i>
                                                <span class="d-none d-lg-inline">DETAIL</span>
                                            </a>
                                            <a href="{{ url('/dashboard/user/' . $row->_id . '/edit') }}"
                                                class="btn btn-sm btn-warning ml-2">
                                                <i class="fa fa-edit"></i>
                                                <span class="d-none d-lg-inline">EDIT</span>
                                            </a>                                            
                                            <form action="{{ url('/dashboard/user/' . $row->_id) }}" method="POST"
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
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 d-flex justify-content-start text-muted mb-3 mb-lg-0">
                    Showing {{ $rows->firstItem() }} to {{ $rows->lastItem() }} out of {{ $rows->total() }} results
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    {{ $rows->links() }}
                </div>
            </div>

        </div>
    </div>

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

</div>

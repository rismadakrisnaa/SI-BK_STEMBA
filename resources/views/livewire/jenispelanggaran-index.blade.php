<div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
      @endif
    @endforeach

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">JENIS PELANGGARAN</h1>
        <a href="{{ url('/dashboard/jenispelanggaran/create') }}"
            class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jenis Pelanggaran</h6>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <tr>
                                <th>NO</th>
                                <th>KODE</th>
                                <th>JENIS PELANGGARAN</th>
                                <th>POIN</th>
                                <th></th>
                            </tr>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->jenispelanggaran_kode }}</td>
                                    <td>{{ $row->jenispelanggaran_nama }}</td>
                                    <td>{{ $row->jenispelanggaran_poin }}</td>
                                    <td>
                                        <div class="d-flex float-right">
                                            <a href="{{ url('/dashboard/jenispelanggaran/' . $row->_id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa fa-info-circle"></i>
                                                <span class="d-none d-lg-inline">DETAIL</span>
                                            </a>
                                            <a href="{{ url('/dashboard/jenispelanggaran/' . $row->_id . '/edit') }}"
                                                class="btn btn-sm btn-warning ml-2">
                                                <i class="fa fa-edit"></i>
                                                <span class="d-none d-lg-inline">EDIT</span>
                                            </a>       
                                            <form action="{{ url('/dashboard/jenispelanggaran/' . $row->_id) }}" method="POST"
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

        </div>
    </div>

</div>
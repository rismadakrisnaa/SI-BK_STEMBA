<div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
      @endif
    @endforeach

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Kelas dan Jurusan</h1>
        <a href="{{ url('/dashboard/kelasjurusan/create') }}"
            class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas dan Jurusan</h6>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <tr>
                                <th>NO</th>
                                <th>KELAS DAN JURUSAN</th>
                                <th>WALI KELAS</th>
                                <th>AKTIF</th>
                                <th></th>
                            </tr>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->kelasjurusan_nama }} (<span class="font-weight-bold">{{ $row->kelasjurusan_kode }}</span>)</td>
                                    <td>{{ !empty($row->guru['guru_gelar_depan']) ? $row->guru['guru_gelar_depan'] . '. ' : '' }}
                                        {{ $row->guru['guru_nama'] }}{{ !empty($row->guru['guru_gelar_belakang']) ? ', ' . $row->guru['guru_gelar_belakang'] : '' }}
                                    </td>
                                    <td><img src="{{ asset('images') }}/{{ $row->kelasjurusan_aktif == 1 ? 1 : 0 }}.png" alt="[IMG]"></td>
                                    <td>
                                        <div class="d-flex float-right">
                                            <a href="{{ url('/dashboard/kelasjurusan/' . $row->_id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa fa-info-circle"></i>
                                                <span class="d-none d-lg-inline">DETAIL</span>
                                            </a>
                                            <a href="{{ url('/dashboard/kelasjurusan/' . $row->_id . '/edit') }}"
                                                class="btn btn-sm btn-warning ml-2">
                                                <i class="fa fa-edit"></i>
                                                <span class="d-none d-lg-inline">EDIT</span>
                                            </a> 
                                            <form action="{{ url('/dashboard/kelasjurusan/' . $row->_id) }}" method="POST"
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
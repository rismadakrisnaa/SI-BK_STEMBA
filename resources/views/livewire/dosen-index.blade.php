<div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }} <a
                    href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
        @endif
    @endforeach

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0">Dosen</h1>
        <a href="{{ url('/dashboard/dosen/create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data dosen</h6>
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
                        <table class="table table-sm table-hover">
                            <tr>
                                <th>NO</th>
                                <th>NIP</th>
                                <th>NIDN</th>
                                <th>NAMA</th>
                                <th>PRODI</th>
                                <th>AKTIF</th>
                                <th></th>
                            </tr>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->dsn_nip }}</td>
                                    <td>{{ $row->dsn_nidn }}</td>
                                    <td>
                                        {{ !empty($row->dsn_gelar_depan) ? $row->dsn_gelar_depan . '. ' : '' }}
                                        {{ $row->dsn_nama }}{{ !empty($row->dsn_gelar_belakang) ? ', ' . $row->dsn_gelar_belakang : '' }}
                                    </td>
                                    <td>{{ $row->fakultas['fak_kode'] }} - {{ $row->prodi['prodi_nama'] }} (<span
                                            class="font-weight-bold">{{ $row->prodi['prodi_kode'] }}</span>)</td>
                                    <td><img src="{{ asset('images') }}/{{ $row->dsn_aktif == 1 ? 1 : 0 }}.png"
                                            alt="[IMG]"></td>
                                    <td>
                                        <div class="d-flex float-right">
                                            <a href="{{ url('/dashboard/dosen/' . $row->_id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa fa-info-circle"></i>
                                                <span class="d-none d-lg-inline">DETAIL</span>
                                            </a>
                                            <a href="{{ url('/dashboard/dosen/' . $row->_id . '/edit') }}"
                                                class="btn btn-sm btn-warning ml-2">
                                                <i class="fa fa-edit"></i>
                                                <span class="d-none d-lg-inline">EDIT</span>
                                            </a>
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

</div>

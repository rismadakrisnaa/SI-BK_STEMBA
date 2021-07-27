@extends('layouts.app')
@section('content')


@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
    @endif
@endforeach

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Siswa</h1>
    @can('admin')
    <a href="{{ url('/dashboard/siswa/create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
    </a>
    @endcan
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="row">
                <div class="col-4">
                    <div class="form-group row no-gutters">
                        <label for="kelas_id" class="col-3">Kelas</label>
                        <span class="col-1 text-center">:</span>
                        <div class="col-8">
                            <select id="kelas_id" class="custom-select custom-select-sm"></select>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover myDataTable" id="datasiswaTable" data-form="dataForm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>NO</th>
                        <th>AVATAR</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>KELAS</th>
                        <th>TEMPAT / TGL LAHIR</th>
                        <th>AKTIF</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allSiswa as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="img-profile rounded-circle" src="{{ $siswa->user->avatar??''}}" style="width: 50px; height: 50px; float:center; border-radius:50%; margin-right:25px;"></td>
                            <td >{{ $siswa->siswa_nis }}</td>
                            <td>{{ $siswa->siswa_nama }}</td>
                            <td>{{ $siswa->kelas->kelasjurusan_nama??'' }}</td>
                            <td>{{ $siswa->siswa_tmplahir }} / {{ \Carbon\Carbon::parse($siswa->siswa_tgllahir)->formatLocalized('%d %B %Y') }}</td>
                            <td>
                                @if ($siswa->siswa_aktif==1)
                                    <div class="text-center"><i class="fa fa-check-double text-success"></i></div>
                                @else
                                    <div class="text-center"><i class="fa fa-times-circle text-danger"></i></div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex float-right">
                                    <a href="{{ url('/dashboard/siswa/' . $siswa->_id) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="fa fa-info-circle"></i>
                                        <span class="d-none d-lg-inline">DETAIL</span>
                                    </a>
                                    @canany(['admin','guru'])
                                    <a href="{{ url('/dashboard/siswa/' . $siswa->_id . '/edit') }}"
                                        class="btn btn-sm btn-warning ml-2">
                                        <i class="fa fa-edit"></i>
                                        <span class="d-none d-lg-inline">EDIT</span>
                                    </a>
                                    <form action="{{ url('/dashboard/siswa/' . $siswa->_id) }}" method="POST"
                                        class="delete-confirm">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <button class="btn btn-danger btn-sm ml-2">
                                            <i class="fa fa-trash"></i>
                                            <span class="d-none d-lg-inline">HAPUS</span>
                                        </button>
                                    </form>
                                    @endcanany
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

{{-- @push('js')
    <script src="{{asset('js/view/siswa.js')}}"></script>
@endpush --}}

@push('js')
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#data-siswa').addClass('active');

        $.ajax({
        url: base_url + "/dashboard/get_kelas",
        async: false,
        success: function(kelas) {
            $("#kelas_id")
                .empty()
                .append('<option value=""></option>');
            kelas.forEach(v => {
                $("#kelas_id").append(
                    `<option value="${v._id}">${v.kelasjurusan_nama}</option>`
                );
            });
        }
    });

    $("#siswa_id")
        .parent()
        .parent()
        .hide();
    $("#kelas_id").change(function() {
        let kelas_id = $(this).val();
        if (kelas_id != "") {
            $.ajax({
                url: base_url + "/dashboard/kelasjurusan/" + kelas_id,
                async: false,
                success: function({ siswa }) {
                    $("#siswa_id")
                        .empty()
                        .append("<option></option>");
                    siswa.forEach(v => {
                        $("#siswa_id").append(
                            `<option value="${v._id}">${v.siswa_nama}</option>`
                        );
                    });
                    $("#siswa_id")
                        .parent()
                        .parent()
                        .fadeIn();
                }
            });
        } else {
            $("#siswa_id")
                .val("")
                .parent()
                .parent()
                .fadeOut();
        }
    });

    var table = $('table[data-form="dataForm"]').on({
        processing: true,
        serverSide: true,
        bSort: false,
        ajax: {
            url: base_url + "/dashboard/get_datasiswa",
            data: function(data) {
                data.kelas = $("#kelas_id").val();
            }
        }});
       
        $("#kelas_id").change(function() {
        table.draw();
        
    });

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

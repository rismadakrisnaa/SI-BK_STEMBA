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
            <table class="table table-hover" id="datasiswaTable">
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

                </tbody>
            </table>
        </div>
  </div>
</div>
@endsection

@push('js')
    <script>
        $('#collapseTwo').addClass('show').parent().addClass('active');
        $('#data-siswa').addClass('active');

        $.ajax({
            url: base_url + "/dashboard/get_kelas",
            async: false,
            success: function(kelas) {
                $("#kelas_id").empty().append('<option value=""></option>');
                kelas.forEach(v => {
                    $("#kelas_id").append(`<option value="${v._id}">${v.kelasjurusan_nama}</option>`);
                });
            }
        });

        $("#siswa_id").parent().parent().hide();

        var table = $('#datasiswaTable').DataTable({
            processing: true,
            serverSide: true,
            bSort: false,
            ajax: {
                url: base_url + "/dashboard/get_datasiswa",
                data: function(data) {
                    data.kelas = $("#kelas_id").val();
                }
            },
            fixedHeader: true,
            "columns": [
                {data:"no"},
                {data:"avatar"},
                {data:"siswa_nis"},
                {data:"siswa_nama"},
                {data:"kelas.kelasjurusan_nama"},
                {data:"tmp_lahir"},
                {data:"status"},
                {data:"action",searchable:false,orderable:false,sortable:false}//action
            ],
            "language": {
                "sEmptyTable":     ("No data available in table"),
                "sInfo":           ("Showing")+" _START_ "+("to")+" _END_ "+("of")+" _TOTAL_ "+("records"),
                "sInfoEmpty":      ("Showing")+" 0 "+("to")+" 0 "+("of")+" 0 "+("records"),
                "sInfoFiltered":   "("+("filtered")+" "+("from")+" _MAX_ "+("total")+" "+("records")+")",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     ("Show")+" _MENU_ "+("records"),
                "sLoadingRecords": ("Loading..."),
                "sProcessing":     ("Processing..."),
                "sSearch":         ("Search")+":",
                "sZeroRecords":    ("No matching records found"),
                "oPaginate": {
                    "sFirst":    ("First"),
                    "sLast":     ("Last"),
                    "sNext":     ("Next"),
                    "sPrevious": ("Previous")
                },
            }
        });

        $("#kelas_id").change(function() {
            console.log($(this).val())
            table.draw();
        });

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

@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Orang Tua</h1>
        <button data-toggle="modal" data-target="#waliModal" id="tambah_data" onclick="tambahWali('Orang Tua',true)" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
        </button>
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @endif
    @endforeach

    @include('layouts.includes.errors')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Orang Tua</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped myDataTable">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Telp</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ortu as $orangTua)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$orangTua->name}}</td>
                                        <td>{{$orangTua->no_telp}}</td>
                                        <td>{{$orangTua->email}}</td>
                                        <td>{{$orangTua->alamat}}</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <button class="btn btn-sm btn-warning mr-2" onclick="editData('{{$orangTua->_id}}')" data-toggle="modal" data-target="#waliModal">
                                                    <div class="fas fa-edit"></div>
                                                    EDIT
                                                </button>
                                                <form action="{{route('orang-tua.destroy',$orangTua->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger delete-confirm"><i class="fas fa-trash"></i> HAPUS</button>
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
        </div>
    </div>

    @include('siswa.wali')
@endsection

@push('js')
    <script>
        function editData(id) {
            $.ajax({
                url: base_url+'/dashboard/orang-tua/'+id,
                async: false,
                success: function(ortu){
                    $('#nama')
                    for(let index in ortu){
                        $('#'+index).val(ortu[index]);
                    }
                    $('#button').attr('onclick', "update('"+id+"')");
                }
            })
        }
        function update(id) {
            let form = new FormData();
            form.append('name',$('#name').val());
            form.append('no_telp',$('#no_telp').val());
            form.append('email',$('#email').val());
            form.append('alamat',$('#alamat').val());
            form.append('_token',$('input[name=_token]').val());
            form.append('_method','put');
            $.ajax({
                url: base_url+'/dashboard/orang-tua/'+id,
                method:'post',
                data: form,
                processData: false,
                contentType: false,
                success: function(result){
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    $('.myDataTable tbody').empty()
                    result.data.forEach((node,i)=>{
                        $('.myDataTable tbody').append(`
                        <tr>
                            <td class="text-center">${i+1}</td>
                            <td>${node.name}</td>
                            <td>${node.no_telp}</td>
                            <td>${node.email}</td>
                            <td>${node.alamat}</td>
                            <td>
                                <div class="d-flex float-right">
                                    <button class="btn btn-sm btn-warning mr-2" onclick="editData('${node._id}')" data-toggle="modal" data-target="#waliModal">
                                        <div class="fas fa-edit"></div>
                                        EDIT
                                    </button>
                                    <form action="/dashboard/orang-tua/${node._id}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger delete-confirm"><i class="fas fa-trash"></i> HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        `)
                    })
                    $('#waliModal').removeClass('show')[0].style='display:none';
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove()
                },
                error:function({responseJSON}){
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: responseJSON.message,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    if(responseJSON.errors){
                        ['name','no_telp','email','alamat'].forEach(i=>{
                            $('#'+i+'-error').html('')
                        })
                        for(let error in responseJSON.errors){
                            let message = responseJSON.errors[error][0];
                            $('#'+error+'-error').html(`<small class="font-italic text-danger">${message}</small>`);
                        }
                    }
                }
            })
        }
        $(document).on('click', '.delete-confirm', function(e) {
            e.preventDefault();
            var form = $(this)[0].form;
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
    <script src="{{asset('js/view/siswa.js')}}"></script>
@endpush

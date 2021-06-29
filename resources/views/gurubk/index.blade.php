@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Guru BK</h1>
        <button data-toggle="modal" data-target="#guruBkModal" id="tambah_data" onclick="tambahData()" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Guru BK</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped myDataTable">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guruBk as $guru)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$guru->nim}}</td>
                                        <td>{{$guru->gelar_depan.' '.$guru->name.' '.$guru->gelar_belakang}}</td>
                                        <td>@include('gurubk._status')</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <button class="btn btn-sm btn-info mr-2" onclick="detailData('{{$guru->_id}}')" data-toggle="modal" data-target="#detailGuruBk">
                                                    <div class="fas fa-info-circle"></div>
                                                    DETAIL
                                                </button>
                                                <button class="btn btn-sm btn-warning mr-2" onclick="editData('{{$guru->_id}}')" data-toggle="modal" data-target="#guruBkModal">
                                                    <div class="fas fa-edit"></div>
                                                    EDIT
                                                </button>
                                                <form action="{{route('gurubk.destroy',$guru->id)}}" method="post" class="delete-confirm">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> HAPUS</button>
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

    @include('gurubk._modal')
    @include('gurubk._detail')
@endsection

@push('js')
    <script src="{{asset('js/view/guru_bk.js')}}"></script>
@endpush

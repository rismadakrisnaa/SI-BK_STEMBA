@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data User</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data User</h6>
                </div>
                <div class="card-body">

                    <form action="{{ url('/dashboard/user/' . $row->_id) }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">NAMA LENGKAP</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('name')is-invalid @enderror" type="text" name="name"
                                    value="{{ $row->name }}" placeholder="Nama Lengkap" required="" autofocus=""
                                    autocomplete="off">

                                @error('name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">EMAIL</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('email')is-invalid @enderror" type="email" name="email"
                                    value="{{ $row->email }}" placeholder="Email" required="">

                                @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">PASSWORD</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('password')is-invalid @enderror" type="password"
                                    name="password" placeholder="Password">
                                    <small class="form-text text-muted mt-2">Kosongkan jika tidak ingin mengubah Password</small>

                                @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">KONFIRMASI PASSWORD</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="Konfirmasi Password">
                            </div>
                        </div>

                        <div class="form-group float-right">
                            <a href="{{ url('/dashboard/user') }}" class="btn btn-primary">
                                <i class="fa fa-arrow-left mr-2"></i> KEMBALI
                            </a>
                            <button class="btn btn-success" type="submit" name="input">
                                <i class="fa fa-save mr-2"></i> UPDATE
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

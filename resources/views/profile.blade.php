@extends('layouts.app')
@section('content')

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }} <a href="#"
                    class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
        @endif
    @endforeach

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">{{ Auth::user()->name }}'s Profile</h1>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile User</h6>
                </div>

                <div class="card-body">

                    <form action="{{ url('/dashboard/profile') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf

                        <img class="img-account-profile rounded-circle mb-2 d-block mx-auto" src="{{ Auth::user()->avatar }}" style="width: 200px; height: 200px; float:center; border-radius:50%; margin-right:25px;">
                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Upload Profil Picture') }}<br>
                            <span class="text-small text-info">*Not required</span>
                            </label>

                            <div class="col-md-6">
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" >

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">NAMA LENGKAP</label>
                            <div class="col-sm-9">
                                <input class="form-control @error('name')is-invalid @enderror" type="text" name="name"
                                    value="{{ $row->name }}" placeholder="Nama Lengkap" required="" autofocus=""
                                    autocomplete="off">

                                @error('name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">EMAIL</label>
                            <div class="col-sm-9">
                                <input class="form-control @error('email')is-invalid @enderror" type="email" name="email"
                                    value="{{ $row->email }}" placeholder="Email" required="">

                                @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">PASSWORD</label>
                            <div class="col-sm-9">
                                <input class="form-control @error('password')is-invalid @enderror" type="password"
                                    name="password" placeholder="Password">
                                    <small class="form-text text-muted mt-2">Kosongkan jika tidak ingin mengubah Password</small>

                                    @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">KONFIRMASI PASSWORD</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="Konfirmasi Password">
                            </div>
                        </div>

                        <div class="form-group float-right">
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

@push('js')
    <script>$('#profile').addClass('active')</script>
@endpush

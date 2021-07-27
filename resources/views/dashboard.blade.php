@extends('layouts.app')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- //Alert Login Suksers --}}
            @can('admin')
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true" style="font-size:20px">×</span>
                </button>    <strong>Welcome, {{ Auth::user()->name }}!</strong> Saat ini kamu login sebagai <strong>User Admin.</strong>
            </div>
            @endcan
            @can('guru')
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true" style="font-size:20px">×</span>
                </button>    <strong>Welcome, {{ Auth::user()->name }}!</strong> Saat ini kamu login sebagai <strong>User Wali Kelas.</strong>
            </div>
            @endcan
            @can('gurubk')
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true" style="font-size:20px">×</span>
                </button>    <strong>Welcome, {{ Auth::user()->name }}!</strong> Saat ini kamu login sebagai <strong>User Guru BK.</strong>
            </div>
            @endcan
            @can('siswa')
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true" style="font-size:20px">×</span>
                </button>    <strong>Welcome, {{ Auth::user()->name }}!</strong> Saat ini kamu login sebagai <strong>User Siswa.</strong>
            </div>
            @endcan
            @can('wali')
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true" style="font-size:20px">×</span>
                </button>    <strong>Welcome, {{ Auth::user()->name }}!</strong> Saat ini kamu login sebagai <strong>User Orang Tua.</strong>
            </div>
            @endcan
            @can('kepsek')
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true" style="font-size:20px">×</span>
                </button>    <strong>Welcome, {{ Auth::user()->name }}!</strong> Saat ini kamu login sebagai <strong>User Kepala Sekolah.</strong>
            </div>
            @endcan



            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                @can(['admin'])
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totaluser}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan

                <!-- Earnings (Monthly) Card Example -->
                @canany(['admin'])
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Siswa</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalsiswa}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

                <!-- Earnings (Monthly) Card Example -->
                @canany(['admin','kepsek','gurubk'])
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Home Visit
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$totalhomevisit}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-paper-plane fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

                @can('siswa')
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Panggilan Konseling
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$panggilanKonseling}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-paper-plane fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Poin Pelanggaran
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$pointPelanggaran}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Absensi
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$absen->where('abses','a')->count().' Alfa, '.$absen->where('abses','s')->count().' Sakit, '.$absen->where('abses','i')->count().' Izin, '.$absen->where('abses','h')->count().' Hadir.'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan

                <!-- Pending Requests Card Example -->
                @canany(['admin','kepsek','gurubk','guru'])
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pelanggaran Siswa</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalpelanggaran}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Siswa</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$siswaKu->count()}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany
                <!-- Pending Requests Card Example -->
                @canany(['admin'])
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Guru</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalguru}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany
                <!-- Earnings (Monthly) Card Example -->
                @canany(['admin','kepsek','gurubk'])
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Panggilan Orang Tua
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$totalpanggilan}}</div>
                                        </div>
                                       </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany
                <!-- Earnings (Monthly) Card Example -->
                @canany(['admin','gurubk'])
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Permintaan Persetujuan Konseling</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalkonseling}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

                @can('wali')
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Poin Pelanggaran</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{!! $pointPelanggaran !!}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Poin Pelanggaran Anak ku ({{$anakKu->count()}}) orang</div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$absenAnakKu['a'].' Alfa, '.$absenAnakKu['s'].' Sakit, '.$absenAnakKu['i'].' Izin, '.$absenAnakKu['h'].' Hadir.'}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan

                {{-- @can(['siswa'])
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Poin Pelanggaran</div> --}}
                                    {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{!! $row->totalPoint() !!}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan --}}
            </div>
        </div>
    </div>

@endsection


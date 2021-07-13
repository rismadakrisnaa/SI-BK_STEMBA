<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
    <div class="sidebar-brand-icon">
        <img  class="img-profile rounded-circle" src="{{ asset('images/logo-smk-n-5-sby.PNG') }}" width="50" height="50" >
    </div>
    <div class="sidebar-brand-text mx-3">SIM BK</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Main Menu
</div>

<!-- Nav Item -->

<li class="nav-item" id="profile">
    <a class="nav-link" href="{{ url('/dashboard/profile') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Profil</span>
    </a>
</li>

@canany(['admin','guru','gurubk','siswa','wali'])
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo" id="master-data">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master Data</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @canany(['admin','guru','gurubk','wali'])
            <a class="collapse-item" href="{{ url('/dashboard/siswa') }}" id="data-siswa">Data Siswa</a>
            @endcanany
            @canany(['admin','siswa','wali'])
            <a class="collapse-item" href="{{ url('/dashboard/gurubk') }}" id="guru-bk">Data Guru BK</a>
            @endcanany
            @can('admin')
            <a class="collapse-item" href="{{ url('/dashboard/kelasjurusan') }}" id="data-kelas">Data Kelas dan Jurusan</a>
            <a class="collapse-item" href="{{ url('/dashboard/guru') }}" id="guru">Data Guru dan Wali Kelas</a>
            <a class="collapse-item" href="{{ url('/dashboard/orang-tua') }}" id="orang-tua">Data Orang Tua</a>
            @endcan
            @canany(['guru','admin'])
            <a class="collapse-item" href="{{ url('/dashboard/absensi') }}" id="absensi">Data Absensi Siswa</a>
            @endcanany
        </div>
    </div>
</li>
@endcanany

@canany(['admin','gurubk','siswa'])
<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard/timeline-akademik') }}" id="timeline-akademik">
        <i class="fas fa-fw fa-users"></i>
        <span>Timeline Akademik</span>
    </a>
</li>
@endcanany

@canany(['admin','gurubk','siswa'])
<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseThree">
        <i class="fas fa-fw fa-cog"></i>
        <span>Bimbingan Konseling</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('/dashboard/pemesanan-jadwal-konseling') }}" id="pemesanan-jadwal-konseling">
                Pemesanan Jadwal <br/>Konseling
            </a>
            @can('siswa')
            <a class="collapse-item" href="{{ url('/dashboard/panggilan') }}" id="panggilan-konseling">Panggilan Konseling <br/>Siswa</a>
            @endcan
            @canany(['admin','gurubk'])
            <a class="collapse-item" href="{{ url('/dashboard/permintaan-konseling') }}" id="permintaan-konseling">
                Permintaan Konseling
            </a>
            @endcanany
            <a class="collapse-item" href="{{ url('/dashboard/hasil-konseling') }}" id="hasil-konseling">
                Hasil Konseling
            </a>
        </div>
    </div>
</li>
@endcanany

{{-- @can('siswa')
<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard/user') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Riwayat Pelanggaran</span>
    </a>
</li>
@endcan --}}

@canany(['admin','guru','gurubk','siswa','kepsek'])
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
        aria-expanded="true" aria-controls="collapseFive">
        <i class="fas fa-fw fa-user-lock"></i>
        <span>Pelanggaran</span>
    </a>
    <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @can('admin')
            <a class="collapse-item" href="{{ url('/dashboard/jenispelanggaran') }}" id="jenis-pelanggaran">Jenis Pelanggaran</a>
            @endcan
            @canany(['admin','guru','gurubk','siswa','kepsek'])
            <a class="collapse-item" href="{{ url('/dashboard/pelanggaran-siswa') }}" id="pelanggaran-siswa">Pelanggaran Siswa</a>
            @endcanany
        </div>
    </div>
</li>
@endcanany

@canany(['admin','gurubk','kepsek'])
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
        aria-expanded="true" aria-controls="collapseFour">
        <i class="fas fa-fw fa-cog"></i>
        <span>Laporan</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('/dashboard/panggilan-ortu') }}" id="panggilan-ortu">Panggilan Orang Tua</a>
            <a class="collapse-item" href="{{ route('home-visit.index') }}" id="home-visit">Home Visit</a>
            <a class="collapse-item" href="{{ url('/dashboard/jenispelanggaran') }}">Hasil Konseling</a>
        </div>
    </div>
</li>
@endcanany

@can('admin')
<!-- Divider -->
<hr class="sidebar-divider mt-3 mb-4">

<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard/user') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>User</span>
    </a>
</li>
@endcan

<!-- Divider -->
<hr class="sidebar-divider mt-3 mb-4">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

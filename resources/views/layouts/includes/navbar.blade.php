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
<li class="nav-item active">
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

<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard/profile') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Profil</span>
    </a>

    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo" id="master-data">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master Data</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('/dashboard/siswa') }}">Data Siswa</a>
            <a class="collapse-item" href="{{ url('/dashboard/kelasjurusan') }}">Data Kelas dan Jurusan</a>
            <a class="collapse-item" href="{{ url('/dashboard/jenispelanggaran') }}">Jenis Pelanggaran</a>
            <a class="collapse-item" href="{{ url('/dashboard/gurubk') }}" id="guru-bk">Data Guru BK</a>
            <a class="collapse-item" href="{{ url('/dashboard/guru') }}">Data Wali Kelas</a>
            <a class="collapse-item" href="{{ url('/dashboard/guru') }}">Data Absensi Siswa</a>
        </div>
    </div>
</li>

<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard/user') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Timeline Akademik</span>
    </a>
</li>

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
            <a class="collapse-item" href="{{ url('/dashboard/kelasjurusan') }}">Panggilan Konseling <br/>Siswa</a>
            <a class="collapse-item" href="{{ url('/dashboard/jenispelanggaran') }}">Pelaksanaan Konseling</a>
            <a class="collapse-item" href="{{ url('/dashboard/guru') }}">Hasil Konseling</a>
        </div>
    </div>
</li>

<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard/user') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Riwayat Pelanggaran</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
        aria-expanded="true" aria-controls="collapseFour">
        <i class="fas fa-fw fa-cog"></i>
        <span>Laporan</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('/dashboard/siswa') }}">Panggilan Orang Tua</a>
            <a class="collapse-item" href="{{ url('/dashboard/kelasjurusan') }}">Home Visit</a>
            <a class="collapse-item" href="{{ url('/dashboard/jenispelanggaran') }}">Hasil Konseling</a>
            <a class="collapse-item" href="{{ url('/dashboard/guru') }}">Absensi Siswa</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider mt-3 mb-4">

<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('/dashboard/user') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>User</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider mt-3 mb-4">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

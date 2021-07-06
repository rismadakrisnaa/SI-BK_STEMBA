<div class="row">
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="custom-select"></select>
        </div>
        <div class="form-group">
            <label for="siswa_id">Nama</label>
            <select name="siswa_id" id="siswa_id" class="custom-select select2"></select>
        </div>
        <div class="form-group">
            <label for="jenispelanggaran_id">Jenis Pelanggaran</label>
            <select name="jenispelanggaran_id" id="jenispelanggaran_id" class="custom-select"></select>
        </div>
        <div class="form-group">
            <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
            <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="permasalahan_siswa">Permasalahan Siswa</label>
            <textarea name="permasalahan_siswa" id="permasalahan_siswa" cols="30" rows="4" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="langkah">Langkah Untuk Ditempuh</label>
            <textarea name="langkah" id="langkah" cols="30" rows="5" class="form-control"></textarea>
        </div>
    </div>
</div>
<hr>
<h3 class="text-center">Guru Bersangkutan</h3>
<div class="form-guru">

</div>
<div class="d-flex justify-content-center">
    <button class="btn" type="button" onclick="addGuru()"><i class="fas fa-plus-square"></i> Klik ikon ini untuk menambah Guru BK yang ditugaskan.</button>
</div>

<hr>
<h3 class="text-center">Form Catatan Home Visit</h3>
<div class="row">
    <div class="col-md-6 col-12">
        <div class="form-group row no-gutters">
            <label for="latar_belakang">Latar Belakang Permasalahan</label>
            <textarea type="text" class="form-control" name="latar_belakang" id="latar_belakang" rows="3"></textarea>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group row no-gutters">
            <label for="saran_guru">Saran Guru BK/Wali Kelas</label>
            <textarea type="text" class="form-control" name="saran_guru" id="saran_guru" rows="3"></textarea>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group row no-gutters">
            <label for="harapan_ortu">Harapan Ortu</label>
            <textarea type="text" class="form-control" name="harapan_ortu" id="harapan_ortu" rows="3"></textarea>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group row no-gutters">
            <label for="solusi">Solusi Yang Diputuskan</label>
            <textarea type="text" class="form-control" name="solusi" id="solusi" rows="3"></textarea>
        </div>
    </div>
</div>

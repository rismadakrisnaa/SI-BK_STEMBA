<div class="form-group row">
    <label class="col-sm-3">Kelas</label>
    <div class="col-sm-9">
        <select name="kelas_id" id="kelas_id" class="custom-select"></select>
    </div>
    @error('kelas_id')
        <i class="text-sm text-danger">{{$message}}</i>
    @enderror
</div>
<div class="form-group row">
    <label class="col-sm-3">Siswa</label>
    <div class="col-sm-9">
        <select name="siswa_id" id="siswa_id" class="custom-select"></select>
    </div>
    @error('siswa_id')
        <i class="text-sm text-danger">{{$message}}</i>
    @enderror
</div>
<div class="form-group row">
    <label class="col-sm-3">Jenis Pelanggaran</label>
    <div class="col-sm-6">
        <select name="pelanggaran_id" id="pelanggaran_id" class="custom-select"></select>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <input type="text" id="point" name="point" readonly class="form-control">
        </div>
    </div>
    @error('pelanggaran_id')
        <i class="text-sm text-danger">{{$message}}</i>
    @enderror
</div>
<div class="form-group row">
    <label for="bukti_foto" class="col-sm-3">Bukti Foto</label>
    <div class="col-sm-9">
        <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="bukti_foto" id="bukti_foto">
              <label class="custom-file-label" for="media">Pilih gambar.</label>
            </div>
        </div>
    </div>
</div>

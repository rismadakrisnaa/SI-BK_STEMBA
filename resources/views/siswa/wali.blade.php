<!-- Modal -->
<div class="modal fade" id="waliModal" tabindex="-1" aria-labelledby="waliModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        @csrf
        <input type="hidden" name="sebagai" id="s" value="">
        <div class="modal-header">
            <h5 class="modal-title" id="waliModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name" id="name-label">Nama Wali</label>
                <input type="text" name="name" id="name" class="form-control">
                <div id="name-error"></div>
            </div>
            <div class="form-group">
                <label for="no_telp" id="no_telp-label">Telp/HP Wali</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control">
                <div id="no_telp-error"></div>
            </div>
            <div class="form-group">
                <label for="email" id="email-label">Email Wali</label>
                <input type="text" name="email" id="email" class="form-control">
                <div id="email-error"></div>
            </div>
            <div class="form-group">
                <label for="alamat" id="alamat-label">Alamat Wali</label>
                <textarea rows="2" id="alamat" name="alamat" class="form-control"></textarea>
                <div id="alamat-error"></div>
            </div>
            <div class="form-group row">
                <label for="kelas_id" id="kelas_id-label" class="col-sm-3">Kelas</label>
                <div class="col-sm-9">
                    <select name="kelas_id" id="kelas_id" class="custom-select"></select>
                </div>
                @error('kelas_id')
                    <i class="text-sm text-danger">{{$message}}</i>
                @enderror
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="siswa" id="siswa_id-label">Orang Tua Dari</label>
                    <select name="siswa_id" id="siswa_id" class="custom-select select2">
                        <option value=""></option>
                    </select>
                </div>
                @error('siswa_id')
                    <i class="text-sm text-danger">{{$message}}</i>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="close-modal" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="button" onclick="save()" class="btn btn-primary" id="button">Simpan</button>
        </div>
      </div>
    </div>
</div>

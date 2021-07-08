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
                <label for="nama" id="nama-label">Nama Wali</label>
                <input type="text" max="nama" id="nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="no_telp" id="no_telp-label">Telp/HP Wali</label>
                <input type="text" max="no_telp" id="no_telp" class="form-control">
            </div>
            <div class="form-group">
                <label for="email" id="email-label">Email Wali</label>
                <input type="text" max="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="alamat" id="alamat-label">Alamat Wali</label>
                <textarea rows="2" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="close-modal" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="button" onclick="save()" class="btn btn-primary" id="button">Simpan</button>
        </div>
      </div>
    </div>
</div>

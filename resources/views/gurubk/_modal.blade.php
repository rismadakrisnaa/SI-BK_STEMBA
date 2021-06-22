<!-- Modal -->
<div class="modal fade" id="guruBkModal" tabindex="-1" aria-labelledby="guruBkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post" id="form">
            @csrf
            @method('patch')
            <div class="modal-header">
                <h5 class="modal-title" id="guruBkModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="number" name="nim" id="nim" class="form-control">
                    @error('nim')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control">
                    @error('name')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gelar_depan">Gelar Depan</label>
                    <input type="text" name="gelar_depan" id="gelar_depan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="gelar_belakang">Gelar Belakang</label>
                    <input type="text" name="gelar_belakang" id="gelar_belakang" class="form-control">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="is_active" type="checkbox" value="1" id="is_active">
                        <label for="is_active" class="custom-control-label">{{__('Aktif')}}</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="button">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>

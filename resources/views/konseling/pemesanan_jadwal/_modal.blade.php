<!-- Modal -->
<div class="modal fade" id="guruBkModal" aria-labelledby="guruBkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post" id="form">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="guruBkModalLabel">Form Pemesanan Jadwal Konseling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{-- <label for="nama">Nama Siswa</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ Auth::user()->name }}">
                    @error('nama')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror --}}
                    <div class="input-group">
                        <label for="siswa_id">Nama Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="custom-select select2">
                            <option value=""></option>
                            @foreach ($siswa as $s)
                                <option value="{{$s->_id}}">{{$s->siswa_nama.' ('.$s->kelas->kelasjurusan_nama}})</option>
                            @endforeach
                        </select>
                    </div>
                    @error('siswa_id')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="custom-select">
                        <option value=""></option>
                        @foreach ($classes as $kelasjurusan)
                            <option value="{{$kelasjurusan->_id}}">{{$kelasjurusan->kelasjurusan_nama}}</option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                <div class="form-group form-row">
                    <div class="col-7">
                        <label for="jadwal">Jadwal Konseling</label>
                        <input type="date" name="jadwal" id="jadwal" class="form-control">
                        @error('jadwal')
                            <i class="text-sm text-danger">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="col-5">
                        <label for="pukul">Pukul</label>
                        <input type="time" name="pukul" id="pukul" class="form-control">
                        @error('pukul')
                            <i class="text-sm text-danger">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="perihal_bimbingan">Perihal Bimbingan</label>
                    <input type="text" name="perihal_bimbingan" id="perihal_bimbingan" class="form-control">
                    @error('perihal_bimbingan')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="guru_bk_id">Guru BK</label>
                    <select name="guru_bk_id" id="guru_bk_id" class="custom-select">
                        <option value=""></option>
                        @foreach ($guruBk as $guru)
                            <option value="{{$guru->_id}}">{{$guru->name}}</option>
                        @endforeach
                    </select>
                    @error('guru_bk_id')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
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

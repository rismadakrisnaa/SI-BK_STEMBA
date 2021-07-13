<!-- Modal -->
<div class="modal fade" id="guruBkModal" aria-labelledby="guruBkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post" id="form">
            @csrf
            <input type="number" value="{{auth()->user()->role=='siswa'?0:1}}" name="panggilan" class="form-control d-none">
            <div class="modal-header">
                <h5 class="modal-title" id="guruBkModalLabel">Form Pemesanan Jadwal Konseling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                <div class="form-group">
                    <div class="input-group">
                        <label for="siswa_id">Nama Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="custom-select select2">
                            <option value=""></option>
                        </select>
                    </div>
                    @error('siswa_id')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                @can('siswa')
                    <script>
                        document.addEventListener('DOMContentLoaded',function(){
                            $('#kelas_id').val('{{auth()->user()->siswa[0]->kelas->_id}}').attr('disabled',true);
                            $('#kelas_id')[0].dispatchEvent(new Event('change'));
                            $('#siswa_id').val('{{auth()->user()->siswa[0]->_id}}').attr('disabled',true);
                        })
                    </script>
                @endcan
                {{-- @can(['gurubk','siswa']) --}}
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
                {{-- <script>
                    document.addEventListener("DOMContentLoaded",function(){
                        $('#guru_bk_id').val('{{auth()->user()->gurubk[0]->_id}}').attr('disabled',true);
                    })
                </script> --}}
                {{-- @endcan --}}
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
                
                <div class="form-group form-row">
                        <label for="jenispertemuan">Jenis Pertemuan</label>
                        <select name="jenispertemuan" id="jenispertemuan" class="custom-select">
                            @foreach (['Virtual Meet','Offline'] as $jenispertemuan)
                                <option value="{{$jenispertemuan}}"{{$jenispertemuan?' selected':''}}>{{$jenispertemuan}}</option>
                            @endforeach
                        </select>
                        
                    @canany(['admin','gurubk'])
                    <div class="col-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="custom-select">
                            @foreach (['pending','approve','rejected'] as $status)
                                <option value="{{$status}}"{{$status?' selected':''}}>{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endcanany
                    @canany(['admin','gurubk'])
                    <div class="col-9">
                        <label for="link">Link Virtual Meet atau Offline Meet</label>
                        <input type="text" class="form-control" value="" name="link" id="link">
                        <small class="form-text text-muted mt-2">Jika pertemuan dilaksanakan secara offline, cukup masukkan keterangan "Offline".</small>
                    </div>
                    @endcanany
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

@push('js')
    <script>
        $('#permintaan-konseling').addClass('active').parent().parent().addClass('show').parent().addClass('active');
        var status = $('#status').val();
        if(status=='approve'){
            $('#link').attr('readonly',false);
        }else{
            $('#link').val('').attr('readonly',true);
        }
        $('#status').change(function(){
            if($(this).val()=='approve'){
                $('#link').attr('readonly',false);
            }else{
                $('#link').val('').attr('readonly',true);
            }
        })
    </script>
@endpush
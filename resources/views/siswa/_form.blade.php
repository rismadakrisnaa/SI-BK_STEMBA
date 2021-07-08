<div class="form-group form-row">
    <label class="col-sm-3">NIS / NISN</label>
    <div class="col-sm-9">
        <div class="form-row">
            <div class="col-5">
                <input class="form-control @error('siswa_nis')is-invalid @enderror" type="number" name="siswa_nis"
                       value="{{ $siswa->siswa_nis??old('siswa_nis') }}" placeholder="Nomor Induk Siswa" required="" autofocus="">
                @error('siswa_nis')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-7">
                <input class="form-control @error('siswa_nisn')is-invalid @enderror" type="number" name="siswa_nisn"
                       value="{{ $siswa->siswa_nisn??old('siswa_nisn') }}" placeholder="Nomor Induk Siswa Nasional" required="">
                @error('siswa_nisn')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="form-group form-row">
    <label for="siswa_avatar" class="col-sm-3">Avatar</label>
    <div class="col-sm-9">
        <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="avatar" id="avatar">
              <label class="custom-file-label" for="avatar">Pilih avatar untuk siswa ini.</label>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">NAMA</label>
    <div class="col-sm-9">
        <input class="form-control" type="text" name="siswa_nama" value="{{ $siswa->siswa_nama??old('siswa_nama') }}" placeholder="Nama" required="">
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">JENIS KELAMIN</label>
    <div class="col-sm-9">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="siswa_jk" value="Laki-laki" id="jk1"
            {{ (isset($siswa)&&$siswa->siswa_jk == 'Laki-laki') ? ' checked' : '' }}>
            <label class="form-check-label" for="jk1">
                Laki-laki
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="siswa_jk" value="Perempuan" id="jk2"
            {{ (isset($siswa)&&$siswa->siswa_jk == 'Perempuan') ? ' checked' : '' }}>
            <label class="form-check-label" for="jk2">
                Perempuan
            </label>
        </div>
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">TEMPAT LAHIR</label>
    <div class="col-sm-9">
        <input class="form-control" type="text" name="siswa_tmplahir" value="{{ $siswa->siswa_tmplahir??old('siswa_tmplahir') }}" placeholder="Tempat Lahir">
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">TANGGAL LAHIR</label>
    <div class="col-sm-4">
        <input class="form-control" type="date" name="siswa_tgllahir" value="{{ $siswa->siswa_tgllahir??old('siswa_tgllahir') }}">
    </div>
</div>
<div class="form-group form-row">
    <label for="siswa_agama" class="col-sm-3">Agama</label>
    <div class="col-sm-9">
        <select name="siswa_agama" id="siswa_agama" class="custom-select">
            <option value=""></option>
            @foreach ($agama as $a)
                <option value="{{$a}}" @if (isset($siswa)&&$siswa->siswa_agama==$a) selected @endif>{{$a}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group form-row">
    <label for="status_anak" class="col-sm-3">Status dalam keluarga</label>
    <div class="col-sm-6 col-7">
        <select name="status_anak" id="status_anak" class="custom-select">
            @foreach (['Kandung','Tiri','Angkat'] as $anak)
                <option value="Anak {{$anak}}" @if (isset($siswa)&&$siswa->status_anak=='Anak '.$anak) selected @endif>Anak {{$anak}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-3 col-5">
        <input type="number" name="anak_ke" value="{{$siswa->anak_ke??old('anak_ke')}}" placeholder="Anak Ke -" class="form-control">
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">ALAMAT</label>
    <div class="col-sm-9">
        <textarea form-rows="3" class="form-control" name="siswa_alamat"
            placeholder="Alamat Lengkap">{{ $siswa->siswa_alamat??old('siswa_alamat') }}</textarea>
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">Telp/HP</label>
    <div class="col-sm-6">
        <input class="form-control" type="number" name="siswa_hp" value="{{ $siswa->siswa_hp??old('siswa_hp') }}" placeholder="Nomor HP">
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">Email</label>
    <div class="col-sm-6">
        <input class="form-control" type="email" name="email" value="{{ $siswa->email??old('email') }}" placeholder="Email">
    </div>
</div>
<div class="form-group form-row">
    <label for="ayah_id" class="col-sm-3">Data Ayah</label>
    <div class="col-sm-9">
        <div class="form-row">
            <div class="col-7">
                <input type="text" name="nama_ayah" placeholder="Nama Ayah" class="form-control" value="{{$siswa->nama_ayah??old('nama_ayah')}}">
            </div>
            <div class="col-5">
                <select name="pekerjaan_ayah" class="custom-select">
                    <option value="">--PILIH PEKERJAAN AYAH--</option>
                    @foreach ($pekerjaan as $work)
                        <option value="{{$work}}"{{(isset($siswa)&&$siswa->pekerjaan_ayah==$work)?' selected':''}}>{{$work}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-row">
    <label for="ibu_id" class="col-sm-3">Data Ibu</label>
    <div class="col-sm-9">
        <div class="form-row">
            <div class="col-7">
                <input type="text" name="nama_ibu" placeholder="Nama Ibu" class="form-control" value="{{$siswa->nama_ibu??old('nama_ibu')}}">
            </div>
            <div class="col-5">
                <select name="pekerjaan_ibu" class="custom-select">
                    <option value="">--PILIH PEKERJAAN IBU--</option>
                    @foreach ($pekerjaan as $work)
                        <option value="{{$work}}"{{(isset($siswa)&&$siswa->pekerjaan_ibu==$work)?' selected':''}}>{{$work}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-row">
    <label for="wali_id" class="col-sm-3">Data Wali</label>
    <div class="col-sm-9">
        <div class="form-row">
            <div class="col-4">
                <input type="text" name="nama_wali" placeholder="Nama Wali" class="form-control" value="{{$siswa->nama_wali??old('nama_wali')}}">
            </div>
            <div class="col-4">
                <input type="number" placeholder="No Telp Wali" name="no_telp_wali" value="{{$siswa->no_telp_wali??old('no_telp_wali')}}" class="form-control">
            </div>
            <div class="col-4">
                <select name="pekerjaan_wali" class="custom-select">
                    <option value="">--PILIH PEKERJAAN WALI--</option>
                    @foreach ($pekerjaan as $work)
                        <option value="{{$work}}"{{(isset($siswa)&&$siswa->pekerjaan_wali==$work)?' selected':''}}>{{$work}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-row">
    <label for="orang_tua_id" class="col-sm-3">Orang Tua Dari</label>
    <div class="col-sm-9">
        <select name="orang_tua_id" id="orang_tua_id" data-value="{{$siswa->orang_tua_id??''}}" class="custom-select">
            <option value=""></option>
        </select>
        <small class="font-italic text-muted">Orang tua belum terdata? klik <a href="#" class="text-success" data-toggle="modal" data-target="#waliModal" onclick="tambahWali('Orang Tua')">Disini</a></small>
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">Kelas</label>
    <div class="col-sm-7">
        @if (count($kelas))
            <select class="custom-select" name="kelas_id">
                @foreach ($kelas as $kelasjurusan)
                    <option value="{{ $kelasjurusan->_id }}"{{ (isset($siswa)&&$kelasjurusan->_id==$siswa->kelas_id) ? ' selected':''}}>
                        {{ $kelasjurusan->kelasjurusan_kode }} - {{ $kelasjurusan->kelasjurusan_nama }} ({{ $kelasjurusan->waliKelas->getFullName() }})
                    </option>
                @endforeach
            </select>
        @else
            <div class="text-danger">Kelas tidak ditemukan</div>
        @endif
    </div>
</div>
<div class="form-group form-row">
    <label class="col-sm-3">AKTIF</label>
    <div class="col-sm-9">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="siswa_aktif" value="1" id="aktif1"
                {{ (isset($siswa)&&$siswa->siswa_aktif == 1) ? ' checked' : '' }}>
            <label class="form-check-label" for="aktif1">
                Aktif
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="siswa_aktif" value="0" id="aktif2"
            {{ (isset($siswa)&&$siswa->siswa_aktif == 0) ? ' checked' : '' }}>
            <label class="form-check-label" for="aktif2">
                Tidak Aktif
            </label>
        </div>
    </div>
</div>

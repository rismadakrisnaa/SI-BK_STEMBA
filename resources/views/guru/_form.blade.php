<div class="form-group row">
    <label class="col-sm-3">NIP</label>
    <div class="col-sm-5">
        <input class="form-control" type="text" value="{{$guru->guru_nip??old('guru_nip')}}"
            name="guru_nip" placeholder="Nomor Induk Pegawai" autofocus="">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3">NUPTK</label>
    <div class="col-sm-6">
        <input class="form-control @error('guru_nidn')is-invalid @enderror" type="text"  value="{{$guru->guru_nidn??old('guru_nidn')}}"
            name="guru_nidn" placeholder="Nomor Induk Guru Nasional" required="">

        @error('guru_nidn')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3">NAMA</label>
    <div class="col-sm-9">
        <input class="form-control @error('guru_nama')is-invalid @enderror" type="text"
            name="guru_nama" placeholder="Nama Lengkap" required="" value="{{$guru->guru_nama??old('guru_nama')}}">

        @error('guru_nama')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3">GELAR DEPAN</label>
    <div class="col-sm-6">
        <input class="form-control" type="text"  value="{{$guru->guru_gelar_depan??old('guru_gelar_depan')}}"
            name="guru_gelar_depan" placeholder="Gelar Depan">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3">GELAR BELAKANG</label>
    <div class="col-sm-5">
        <input class="form-control" type="text" value="{{$guru->guru_gelar_belakang??old('guru_gelar_belakang')}}"
            name="guru_gelar_belakang" placeholder="Gelar Belakang">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3">NO TELEPON</label>
    <div class="col-sm-9">
        <input class="form-control @error('no_telepon')is-invalid @enderror" type="number"
            name="no_telepon" placeholder="Nomer Telepon" required="" value="{{$guru->no_telepon??old('no_telepon')}}">

        @error('no_telepon')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3">EMAIL</label>
    <div class="col-sm-9">
        <input class="form-control @error('email')is-invalid @enderror" type="email"
            name="email" placeholder="Nomer Telepon" required="" value="{{$guru->email??old('email')}}">

        @error('email')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3">JENIS KELAMIN</label>
    <div class="col-sm-9">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="guru_jk" value="Laki-laki" id="jk1"
                @if (isset($guru)&&$guru->guru_jk=='Laki-laki') checked @endif>
            <label class="form-check-label" for="jk1">
                Laki-laki
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="guru_jk" value="Perempuan" id="jk2"
            @if (isset($guru)&&$guru->guru_jk=='Perempuan') checked @endif>
            <label class="form-check-label" for="jk2">
                Perempuan
            </label>
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3">MENGAJAR MAPEL</label>
    <div class="col-sm-5">
        <input class="form-control" type="text" value="{{$guru->mengajar_mapel??old('mengajar_mapel')}}"
            name="mengajar_mapel" placeholder="Mengajar Mata Pelajaran">
    </div>
</div>

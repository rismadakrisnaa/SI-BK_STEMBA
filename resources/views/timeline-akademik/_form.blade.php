<div class="card mt-3">
    <div class="card-body">
        <div class="form-group">
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="media">
                  <label class="custom-file-label" for="media">Pilih media (gambar atau video).</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-primary" id="upload" type="button">
                        Upload
                        <img id="loader" src="{{asset('images/loader.gif')}}" width="20" height="20" alt="" srcset="">
                    </button>
                </div>
            </div>
            <span class="text-sm">
                Jika ada media yang ingin dilampirkan (seperti gambar atau video), silahkan upload dulu kesini, nanti akan ada link.
            </span>
        </div>
    </div>
</div>

<div class="card mt-4">
    <form action="{{$action??''}}" method="post">
        @csrf
        {!!$optional??''!!}
        <div class="card-body">
            <div class="form-group">
                <label for="judul">Judul Timeline</label>
                <input type="text" id="judul" name="judul" class="form-control" value="{{$timelineAkademik->judul??old('judul')}}">
            </div>
            <textarea name="body" id="mytextarea" cols="30" rows="100">{{$timelineAkademik->body??old('body')}}</textarea>
            <button class="btn btn-success mt-2">
                <i class="fas fa-save"></i>
                Simpan
            </button>
        </div>
    </form>
</div>

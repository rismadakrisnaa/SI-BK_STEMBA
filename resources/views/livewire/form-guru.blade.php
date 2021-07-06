<div>
    @foreach ($guru as $index => $item)
        <div class="form-group row">
            <div class="col-5">
                <label for="guru_bk{{$index}}">Guru BK {{$index+1}}</label>
                <select name="guru_bk[{{$index}}][nama]" id="guru_bk{{$index}}" class="custom-select">
                    <option value=""></option>
                    @foreach ($dataGuru as $guru)
                        <option value="{{$guru['nama']}}">{{$guru['nip']}} - {{$guru['nama']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-5">
                <label for="jabatan{{$index}}">Jabatan {{$index+1}}</label>
                <input type="text" name="jabatan[{{$index}}][jabatan]" id="jabatan{{$index}}" class="form-control">
            </div>
            <div class="col-2">
                <label>Aksi</label>
                <button class="btn btn-danger col" wire:click.prevent="deleteGuru({{$index}})">
                    <i class="fas fa-trash"></i> <span class="d-none d-md-inline">Hapus</span>
                </button>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        <button class="btn" wire:click.prevent="addGuru"><i class="fas fa-plus-square"></i> Klik ikon ini untuk menambah Guru BK yang ditugaskan.</button>
    </div>
</div>

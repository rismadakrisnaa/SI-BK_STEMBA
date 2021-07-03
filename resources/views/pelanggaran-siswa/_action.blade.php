<div class="d-flex float-right">
    <a href="{{route('pelanggaran-siswa.show',$data->_id)}}" class="btn btn-sm btn-info mr-2">
        <div class="fas fa-info-circle"></div>
        DETAIL
    </a>
    <a href="{{route('pelanggaran-siswa.edit',$data->_id)}}" class="btn btn-sm btn-warning mr-2">
        <div class="fas fa-edit"></div>
        EDIT
    </a>
    <form action="{{route('pelanggaran-siswa.destroy',$data->id)}}" method="post" class="delete-confirm">
        @method('delete')
        @csrf
        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> HAPUS</button>
    </form>
</div>

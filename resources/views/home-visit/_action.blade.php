<div class="d-flex float-right">
    <form action="/dashboard/home-visit/cetak/{{$data->_id}}" target="_blank" method="post">
        @method('put')
        @csrf
        <button class="btn btn-sm btn-success mr-2"><i class="fas fa-file-pdf"></i> CETAK</button>
    </form>
    <a href="{{route('home-visit.show',$data->_id)}}" class="btn btn-sm btn-info mr-2">
        <div class="fas fa-info-circle"></div>
        DETAIL
    </a>
    <a href="{{route('home-visit.edit',$data->_id)}}" class="btn btn-sm btn-warning mr-2">
        <div class="fas fa-edit"></div>
        EDIT
    </a>
    <form action="{{route('home-visit.destroy',$data->id)}}" method="post" class="delete-confirm">
        @method('delete')
        @csrf
        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> HAPUS</button>
    </form>
</div>

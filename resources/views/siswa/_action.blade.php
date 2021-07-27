<div class="d-flex float-right">
    <a href="{{ url('/dashboard/siswa/' . $siswa->_id) }}"
        class="btn btn-sm btn-info">
        <i class="fa fa-info-circle"></i>
        <span class="d-none d-lg-inline">DETAIL</span>
    </a>
    @canany(['admin','guru'])
    <a href="{{ url('/dashboard/siswa/' . $siswa->_id . '/edit') }}"
        class="btn btn-sm btn-warning ml-2">
        <i class="fa fa-edit"></i>
        <span class="d-none d-lg-inline">EDIT</span>
    </a>
    <form action="{{ url('/dashboard/siswa/' . $siswa->_id) }}" method="POST"
        class="delete-confirm">
        <input type="hidden" name="_method" value="DELETE">
        @csrf
        <button class="btn btn-danger btn-sm ml-2">
            <i class="fa fa-trash"></i>
            <span class="d-none d-lg-inline">HAPUS</span>
        </button>
    </form>
    @endcanany
</div>

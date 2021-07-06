@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Tambah Pelanggaran Siswa</h1>
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @endif
    @endforeach

    @include('layouts.includes.errors')

    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Pelanggaran Siswa</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('home-visit.update',$homeVisit->_id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('home-visit._form')
                <div class="form-group float-right">
                    <a href="{{ route('home-visit.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left mr-2"></i> KEMBALI
                    </a>
                    <button class="btn btn-success" type="submit" name="input">
                        <i class="fa fa-save mr-2"></i> SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('js/view/home_visit.js')}}"></script>
    <script>
        $.ajax({
            url: '',
            async: false,
            success: function(result){
                let excepted = ['guru','siswa'];
                $('#kelas_id').val(result.kelas_id);
                var event = new Event('change');
                $('#kelas_id')[0].dispatchEvent(event);
                for(index in result){
                    if(!excepted.includes(index)){
                        $('#'+index).val(result[index]);
                    }
                }
                $('.form-guru').empty();
                for(index in result.guru){
                    let data = [];
                    for(i in result.guru[index]){
                        data.push(result.guru[index][i]);
                    }
                    addGuru(data[0]??'', data[1]??'');
                }
                // for(index in result.guru){
                //     console.log($('#guru_bk'+index));
                //     console.log(result.guru[index]);
                //     $('#guru_bk'+index).val(result.guru[index].nama);
                //     $('#jabatan'+index).val(result.guru[index].jabatan);
                // }
            }
        })
    </script>
@endpush

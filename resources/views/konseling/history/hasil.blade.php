@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Response Permintaan Konseling</h1>
</div>

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if (Session::has('alert-' . $msg))
        <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @endif
@endforeach

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Response Permintaan Konseling</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('pemesanan-jadwal-konseling.update',$konseling->_id)}}">
                    @method('patch')
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-8 col-12">
                            <div class="form-group">
                                <label for="kelas_id">Kelas</label>
                                <input type="text" value="{{$konseling->classes->kelasjurusan_nama}}" disabled class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="siswa_id">Nama Siswa</label>
                                <input type="text" value="{{$konseling->siswa->siswa_nama}}" disabled class="form-control">
                            </div>
                            <div class="form-group form-row">
                                <div class="col-7">
                                    <label for="jadwal">Jadwal Konseling</label>
                                    <input type="date" name="jadwal" id="jadwal" disabled value="{{$konseling->jadwal}}" class="form-control">
                                    @error('jadwal')
                                        <i class="text-sm text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="col-5">
                                    <label for="pukul">Pukul</label>
                                    <input type="time" name="pukul" disabled id="pukul" value="{{$konseling->pukul}}" class="form-control">
                                    @error('pukul')
                                        <i class="text-sm text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="perihal_bimbingan">Perihal Bimbingan</label>
                                <input type="text" name="perihal_bimbingan" value="{{$konseling->perihal_bimbingan}}" disabled id="perihal_bimbingan" class="form-control">
                            </div>
                            <div class="form-group form-row">
                                <div class="col-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" disabled class="custom-select">
                                        @foreach (['pending','approve','rejected'] as $status)
                                            <option value="{{$status}}"{{$konseling->status==$status?' selected':''}}>{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-9">
                                    <label for="link">Link Virtual Meet</label>
                                    <input type="url" class="form-control" disabled value="{{$konseling->link}}" name="link" id="link">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="form-group">
                                <label for="hasil_konseling">Hasil Konseling</label>
                                <textarea name="hasil_konseling" id="hasil_konseling" cols="30" style="height: 380px" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <a href="{{ url('/dashboard/permintaan-konseling/') }}" class="btn btn-primary">
                            <i class="fa fa-arrow-left mr-2"></i> KEMBALI
                        </a>
                        <button class="btn btn-success" type="submit">
                            <i class="fa fa-save mr-2"></i> SIMPAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.includes.errors')
@endsection

@push('js')
    <script>
        $('#hasil-konseling').addClass('active').parent().parent().addClass('show').parent().addClass('active');
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

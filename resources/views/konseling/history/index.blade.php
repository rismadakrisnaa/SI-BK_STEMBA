@extends('layouts.app')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">History Konseling</h1>
        <button data-toggle="modal" data-target="#guruBkModal" id="tambah_data" onclick="tambahData()" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Jadwal
        </button>
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @endif
    @endforeach

    @include('layouts.includes.errors')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data History Konseling</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped myDataTable">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Jadwal Konseling</th>
                                <th>Nama Siswa</th>
                                <th>Nama Guru BK</th>
                                <th>Perihal Konseling</th>
                                <th>Hasil Konseling</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesertaKonseling as $peserta)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{date('d/m/Y',strtotime($peserta->jadwal))}}</td>
                                    <td>{{$peserta->nama}}</td>
                                    <td>{{$peserta->guruBk->name}}</td>
                                    <td>{{$peserta->perihal_bimbingan}}</td>
                                    <td>{{$peserta->hasil_konseling}}</td>
                                    <td>
                                        <div class="d-flex float-right">
                                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailPesananModal" onclick="detailPesanan('{{$peserta->_id}}')">
                                                <div class="fas fa-info-circle"></div>
                                                DETAIL
                                            </button>
                                            <button class="btn btn-sm btn-success"><i class="fas fa-file-pdf"></i> CETAK</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('konseling.pemesanan_jadwal._modal')

    @include('konseling.pemesanan_jadwal._modal-detail')
@endsection

@push('js')
    <script>
        $('#detail-updated_at').parent().remove();
        $('#detail-perihal_bimbingan').parent().after(`
        <tr>
            <td>Hasil Konseling</td><td id="detail-hasil_konseling"></td>
        </tr>`);
    </script>
    <script src="{{asset('js/view/pemesanan_jadwal_konseling.js')}}"></script>
    <script>
        $('#pemesanan-jadwal-konseling').removeClass('active');
        $('#detailPesananModalLabel').text('Detail History Konseling');
        $('#detailPesananModal .modal-dialog').addClass('modal-lg');
        $('#hasil-konseling').addClass('active');
    </script>
@endpush

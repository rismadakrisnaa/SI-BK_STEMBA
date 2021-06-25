<!-- Modal -->
<div class="modal fade" id="detailPesananModal" tabindex="-1" aria-labelledby="detailPesananModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="detailPesananModalLabel">Form Pemesanan Jadwal Konseling</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <td>ID</td><td id="detail-_id"></td>
                    </tr>
                    <tr>
                        <td>Jadwal Konseling</td><td id="detail-jadwal"></td>
                    </tr>
                    <tr>
                        <td>Pukul</td><td id="detail-pukul"></td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td><td id="detail-nama"></td>
                    </tr>
                    <tr>
                        <td>Kelas</td><td id="detail-kelas"></td>
                    </tr>
                    <tr>
                        <td>Nama Guru BK</td><td id="detail-guru_bk"></td>
                    </tr>
                    <tr>
                        <td>Perihal Bimbingan</td><td id="detail-perihal_bimbingan"></td>
                    </tr>
                    <tr>
                        <td>Link Virtual Meet</td><td id="detail-link"></td>
                    </tr>
                    <tr>
                        <td>Dibuat</td><td id="detail-created_at"></td>
                    </tr>
                    <tr>
                        <td>Diedit</td><td id="detail-updated_at"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>

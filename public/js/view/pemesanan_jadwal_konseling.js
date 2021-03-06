$("#collapseThree")
    .addClass("show")
    .parent()
    .addClass("active");
$("#pemesanan-jadwal-konseling").addClass("active");

function detailPesanan(id) {
    $.ajax({
        url: "pemesanan-jadwal-konseling/" + id,
        success: function(peserta) {
            let jadwal = peserta.jadwal
                .split("-")
                .reverse()
                .join("/");
            $("#detailPemesananModalLabel").text(
                "Detail Pemesanan Jadwal Konseling"
            );
            for (i in peserta) {
                $("#detail-" + i).text(peserta[i]);
            }
            $("#detail-jadwal").text(jadwal);
            $("#detail-nama").text(peserta.siswa.siswa_nama);
            $("#detail-kelas").text(peserta.classes.kelasjurusan_nama);
            $("#detail-guru_bk").text(peserta.guru_bk.name);
        }
    });
    $("#button").text("Edit");
}

$("#kelas_id").change(function() {
    let kelas_id = $(this).val();
    $.ajax({
        url: base_url + "/dashboard/kelasjurusan/" + kelas_id,
        async: false,
        success: function(kelas) {
            $("#siswa_id")
                .empty()
                .append("<option></option>");
            kelas.siswa.forEach(i => {
                $("#siswa_id").append(
                    `<option value="${i._id}">${i.siswa_nama}</option>`
                );
            });
        }
    });
});

$(document).on("click", ".delete-confirm", function(e) {
    e.preventDefault();
    var form = $(this);
    Swal.fire({
        title: "Anda Yakin?",
        text: "Data ini akan dihapus secara permanen",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus permanen!"
    }).then(result => {
        if (result.value) {
            form.submit();
        }
    });
});

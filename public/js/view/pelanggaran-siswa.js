(function($) {
    "use strict";

    //active
    $("#collapseFive")
        .addClass("show")
        .parent()
        .addClass("active");
    $("#pelanggaran-siswa").addClass("active");

    // Initialization Data
    $.ajax({
        url: base_url + "/dashboard/get_kelas",
        async: false,
        success: function(kelas) {
            $("#kelas_id")
                .empty()
                .append('<option value=""></option>');
            kelas.forEach(v => {
                $("#kelas_id").append(
                    `<option value="${v._id}">${v.kelasjurusan_nama}</option>`
                );
            });
        }
    });

    $.ajax({
        url: base_url + "/dashboard/get_jenispelanggaran",
        async: false,
        success: function(pelanggaran) {
            $("#pelanggaran_id")
                .empty()
                .append('<option value=""></option>');
            pelanggaran.forEach(v => {
                $("#pelanggaran_id").append(
                    `<option data-poin="${v.jenispelanggaran_poin}" value="${v._id}">(${v.jenispelanggaran_kode}) ${v.jenispelanggaran_nama}</option>`
                );
            });
        }
    });

    $("#siswa_id")
        .parent()
        .parent()
        .hide();
    $("#kelas_id").change(function() {
        let kelas_id = $(this).val();
        if (kelas_id != "") {
            $.ajax({
                url: base_url + "/dashboard/kelasjurusan/" + kelas_id,
                async: false,
                success: function({ siswa }) {
                    $("#siswa_id")
                        .empty()
                        .append("<option></option>");
                    siswa.forEach(v => {
                        $("#siswa_id").append(
                            `<option value="${v._id}">${v.siswa_nama}</option>`
                        );
                    });
                    $("#siswa_id")
                        .parent()
                        .parent()
                        .fadeIn();
                }
            });
        } else {
            $("#siswa_id")
                .val("")
                .parent()
                .parent()
                .fadeOut();
        }
    });

    $("#pelanggaran_id").change(function() {
        let point = $(this)
            .find(":selected")
            .data("poin");
        $("#point").val(point + " point");
    });

    //admin groups datatable
    var table = $("#pelanggaranTable").DataTable({
        processing: true,
        serverSide: true,
        bSort: false,
        ajax: {
            url: base_url + "/dashboard/get_pelanggaran",
            data: function(data) {
                data.kelas = $("#kelas_id").val();
                data.orderBy = $("#order_by").val();
            }
        },
        // orderCellsTop: true,
        fixedHeader: true,
        columns: [
            { data: "no" },
            { data: "siswa.siswa_nama" },
            { data: "siswa.kelas.kelasjurusan_nama" },
            { data: "pelanggaran.jenispelanggaran_nama" },
            { data: "pelanggaran.jenispelanggaran_poin" },
            {
                data: "action",
                searchable: false,
                orderable: false,
                sortable: false
            } //action
        ],
        language: {
            sEmptyTable: "No data available in table",
            sInfo:
                "Showing" +
                " _START_ " +
                "to" +
                " _END_ " +
                "of" +
                " _TOTAL_ " +
                "records",
            sInfoEmpty:
                "Showing" + " 0 " + "to" + " 0 " + "of" + " 0 " + "records",
            sInfoFiltered:
                "(" +
                "filtered" +
                " " +
                "from" +
                " _MAX_ " +
                "total" +
                " " +
                "records" +
                ")",
            sInfoPostFix: "",
            sInfoThousands: ",",
            sLengthMenu: "Show" + " _MENU_ " + "records",
            sLoadingRecords: "Loading...",
            sProcessing: "Processing...",
            sSearch: "Search" + ":",
            sZeroRecords: "No matching records found",
            oPaginate: {
                sFirst: "First",
                sLast: "Last",
                sNext: "Next",
                sPrevious: "Previous"
            }
        }
    });

    $("#kelas_id").change(function() {
        table.draw();
    });
    $("#order_by ").change(function() {
        table.draw();
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
})(jQuery);

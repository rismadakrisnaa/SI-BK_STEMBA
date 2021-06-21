(function($){
    $('#master-data').addClass('active').next().addClass('show');
    $('#guru-bk').addClass('active');

    "use_strict";

     var table=$('#guru_bk_table').DataTable({
        "language": {
            "sEmptyTable":     ("No data available in table"),
            "sInfo":           ("Showing")+" _START_ "+("to")+" _END_ "+("out of")+" _TOTAL_ "+("results"),
            "sInfoEmpty":      ("Showing")+" 0 "+("to")+" 0 "+("out of")+" 0 "+("results"),
            "sInfoFiltered":   "("+("filtered")+" "+("from")+" _MAX_ "+("total")+" "+("records")+")",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     ("Per Page : ")+" _MENU_ ",
            "sLoadingRecords": ("Loading..."),
            "sProcessing":     ("Processing..."),
            "sSearch":         ("Search")+":",
            "sZeroRecords":    ("No matching records found"),
            "oPaginate": {
                "sFirst":    ("First"),
                "sLast":     ("Last"),
            }
        }
     });
})(jQuery);

function tambahData(){
    $('#guruBkModalLabel').text('Tambah Data Guru BK');
    $('input[name=_method]').attr('disabled',true);
    $('#nim').val('');
    $('#name').val('');
    $('#gelar_depan').val('');
    $('#gelar_belakang').val('');
    $('#form').attr('action','');
    $('#button').text('Simpan');
}
function editData(id) {
    $.ajax({
        url: 'gurubk/'+id,
        success: function(guru){
            $('input[name=_method]').attr('disabled',false);
            $('#guruBkModalLabel').text('Edit Data Guru BK '+guru.name);
            $('#form').attr('action','gurubk/'+id);
            for(i in guru){
                $('#'+i).val(guru[i])
            }
            $('#is_active').attr('checked',typeof guru.is_active != 'undefined');
        }
    })
    $('#button').text('Edit');
}

$(document).on('click', '.delete-confirm', function(e) {
    e.preventDefault();
    var form = $(this);
    Swal.fire({
        title: 'Anda Yakin?',
        text: 'Data ini akan dihapus secara permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus permanen!'
    }).then((result) => {
        if (result.value) {
            form.submit();
        }
    });
});

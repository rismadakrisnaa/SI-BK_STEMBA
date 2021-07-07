(function($){

    "use strict";

    //active
    $('#collapseFour').addClass('show').parent().addClass('active');
    $('#panggilan-ortu').addClass('active');

    // Initialization Data
    $.ajax({
        url: base_url+'/dashboard/get_kelas',
        async: false,
        success:function(kelas){
            $('#kelas_id').empty().append('<option value=""></option>');
            kelas.forEach(v=>{
                $('#kelas_id').append(`<option value="${v._id}">${v.kelasjurusan_nama}</option>`);
            });
        }
    })

    $.ajax({
        url: base_url+'/dashboard/get_guru_bk',
        async: false,
        success:function(guru){
            $('#gurubk_id').empty().append('<option value=""></option>');
            guru.forEach(v=>{
                $('#gurubk_id').append(`<option value="${v._id}">${v.nim} - ${v.name}</option>`);
            });
        }
    })

    $('#kelas_id').change(function(){
        let kelas_id = $(this).val();
        if(kelas_id!=''){
            $.ajax({
                url: base_url+'/dashboard/kelasjurusan/'+kelas_id,
                async: false,
                success: function({siswa}){
                    $('#siswa_id').empty();
                    siswa.forEach(v=>{
                        $('#siswa_id').append(`<option value="${v._id}">${v.siswa_nama}</option>`);
                    })
                }
            })
        }else{$('#siswa_id').val('')}
    })

    //admin groups datatable
   var table=$('#panggilanOrtuTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
        url: base_url+"/dashboard/get_panggilan-ortu",
        data:function(data)
        {
            data.kelas=$('#kelas_id').val();
        }
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
        {data:"no"},
        {data:"siswa.siswa_nama"},
        {data:"siswa.kelasjurusan.kelasjurusan_nama"},
        {data:"tanggal_panggilan"},
        {data:"action",searchable:false,orderable:false,sortable:false}//action
        ],
        "language": {
        "sEmptyTable":     ("No data available in table"),
        "sInfo":           ("Showing")+" _START_ "+("to")+" _END_ "+("of")+" _TOTAL_ "+("records"),
        "sInfoEmpty":      ("Showing")+" 0 "+("to")+" 0 "+("of")+" 0 "+("records"),
        "sInfoFiltered":   "("+("filtered")+" "+("from")+" _MAX_ "+("total")+" "+("records")+")",
        "sInfoPostFix":    "",
        "sInfoThousands":  ",",
        "sLengthMenu":     ("Show")+" _MENU_ "+("records"),
        "sLoadingRecords": ("Loading..."),
        "sProcessing":     ("Processing..."),
        "sSearch":         ("Search")+":",
        "sZeroRecords":    ("No matching records found"),
        "oPaginate": {
            "sFirst":    ("First"),
            "sLast":     ("Last"),
            "sNext":     ("Next"),
            "sPrevious": ("Previous")
        },
        }
    });

    $('#kelas_id').change(function(){
        table.draw();
    })

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

})(jQuery);

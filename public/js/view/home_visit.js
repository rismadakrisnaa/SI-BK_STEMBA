(function($){

    "use strict";

    //active
    $('#collapseFour').addClass('show');
    $('#home-visit').addClass('active');

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
        url: base_url+'/dashboard/get_jenispelanggaran',
        async: false,
        success:function(kelas){
            $('#jenispelanggaran_id').empty().append('<option value=""></option>');
            kelas.forEach(v=>{
                $('#jenispelanggaran_id').append(`<option value="${v._id}">${v.jenispelanggaran_nama} (${v.jenispelanggaran_poin} point)</option>`);
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
                    $('#siswa_id').empty().append('<option></option>');
                    siswa.forEach(v=>{
                        $('#siswa_id').append(`<option value="${v._id}">${v.siswa_nama}</option>`);
                    })
                }
            })
        }else{$('#siswa_id').val('')}
    })

    //admin groups datatable
   var table=$('#homeVisitTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
        url: base_url+"/dashboard/get_home_visit",
        data:function(data)
        {
            data.kelas=$('#kelas_id').val();
            data.orderBy=$('#order_by').val();
        }
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
        {data:"no"},
        {data:"siswa.siswa_nama"},
        {data:"siswa.kelasjurusan.kelasjurusan_nama"},
        {data:"tanggal_kunjungan"},
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

var index=1;
addGuru();

function addGuru(nama,jabatan) {
    var template = `
    <div class="form-group row">
        <div class="col-7">
            <label for="guru_bk${index}">Guru BK ${index}</label>
            <select name="guru[${index}]['nama']" id="guru_bk${index}" class="custom-select">
                <option value=""></option>

            </select>
        </div>
        <div class="col-5">
            <label for="jabatan${index}">Jabatan ${index}</label>
            <input type="text" name="guru[${index}]['jabatan']" id="jabatan${index}" class="form-control">
        </div>
    </div>
    `
    $('.form-guru').append(template)
    $.ajax({
        url: base_url+'/dashboard/get_guru',
        async: false,
        success: function(guru){
            guru.forEach(g=>{
                if(typeof nama == 'undefined'){
                    $('#guru_bk'+index).append(`<option value="${g.nama}">${g.nip} - ${g.nama}</option>`);
                }else{
                    if(nama==g.nama){
                        $('#guru_bk'+index).append(`<option value="${g.nama}" selected>${g.nip} - ${g.nama}</option>`);
                    }else{
                        $('#guru_bk'+index).append(`<option value="${g.nama}">${g.nip} - ${g.nama}</option>`);
                    }
                }
            })
            if(typeof jabatan!='undefined'){
                $('#jabatan'+index).val(jabatan);
            }
        }
    })
    index++;
}

$('#collapseTwo').addClass('show').parent().addClass('active');
$('#guru-bk').addClass('active');

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

function detailData(id) {
    $.ajax({
        url: 'gurubk/'+id,
        success: function(guru){
            console.log(guru);
            $('#detailGuruBkLabel').text('Detail Data Guru BK '+guru.name);
            for(i in guru){
                $('#detail-'+i).text(guru[i])
            }
            if(guru.is_active==1){
                $('#detail-status').html('<div class="text-center"><i class="fa fa-check-double text-success"></i></div>');
            }else{
                $('#detail-status').html('<div class="text-center"><i class="fa fa-times-circle text-danger"></i></div>');
            }
            $('#DetailGuruBk').on('show.bs.modal');
        }
    })
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

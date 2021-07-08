function tambahWali(wali) {
    $('#waliModalLabel').text('Tambah Data Orang Tua Siswa ('+wali+')');
    $('#nama-label').text('Nama '+wali);
    $('#no_telp-label').text('Telp/HP '+wali);
    $('#email-label').text('Email '+wali);
}

function initOrangTua() {
    var ortu_id=$('#orang_tua_id').data('value');
    $.ajax({
        url: base_url+'/dashboard/get_orang_tua',
        async: false,
        success: function(ortu){
            $('#orang_tua_id').empty().append('<option></option>');
            ortu.forEach(v=>{
                $('#orang_tua_id').append(`<option value="${v._id}">${v.name}</option>`);
            })
            $('#orang_tua_id').val(ortu_id);
        }
    })
}
initOrangTua();

function save() {
    let form = new FormData();
    form.append('name',$('#nama').val());
    form.append('no_telp',$('#no_telp').val());
    form.append('email',$('#email').val());
    form.append('_token',$('input[name=_token]').val());
    $.ajax({
        url: base_url+'/dashboard/orang-tua',
        method:'post',
        data: form,
        processData: false,
        contentType: false,
        success: function(result){
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: result,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            $('#waliModal').removeClass('show')[0].style='display:none';
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove()
            initOrangTua();
        },
        error:function({responseJSON}){
            console.log(responseJSON.errors);
        }
    })
}

@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-0">
        <h1 class="h3 mb-0 text-gray-800 mb-2 mb-lg-0 font-weight-bold">Form Timeline Akademik</h1>
        <a href="/dashboard/timeline-akademik/" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left mr-2 fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible mt-2 fade show">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @endif
    @endforeach

    @include('layouts.includes.errors')

    <div class="card mt-3">
        <div class="card-body">
            <div class="form-group">
                <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="media">
                      <label class="custom-file-label" for="media">Pilih media (gambar atau video).</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="upload" type="button">
                            Upload
                            <img id="loader" src="{{asset('images/loader.gif')}}" width="20" height="20" alt="" srcset="">
                        </button>
                    </div>
                </div>
                <span class="text-sm">
                    Jika ada media yang ingin dilampirkan (seperti gambar atau video), silahkan upload dulu kesini, nanti akan ada link.
                </span>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <form action="{{route('timeline-akademik.store')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="judul">Judul Timeline</label>
                    <input type="text" id="judul" name="judul" class="form-control">
                </div>
                <textarea name="body" id="mytextarea" cols="30" rows="100"></textarea>
                <button class="btn btn-success mt-2">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>

@endsection

@push('js')
    <script src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>
    <script>
        $('#timeline-akademik').parent().addClass('active');
        //text editor
    tinymce.init({
        selector: '#mytextarea',
        setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });},
        height: 600,
        theme: 'silver',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help','directionality',
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |ltr rtl',
        toolbar2: 'print preview media | forecolor backcolor emoticons | fontsizeselect | codesample help',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 50pt',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        ]
        });
        $('#loader').hide();
        $('#upload').click(function(){
            let media = $('#media');
            if(media.val().trim()===''){
                $(this).parent().parent().parent().append(`
                    <br><i id="text-error" class="text-danger text-sm">Silahkan pilih media terlebih dahulu.</i>
                `);
            }else{
                $('#loader').show();
                $('#text-error').remove();
                let fd = new FormData();
                fd.append('media',media[0].files[0]);
                fd.append('_token',$('input[name=_token]').val());

                $.ajax({
                    url: 'post_media',
                    method: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(result){
                        Swal.fire({
                            title: '<strong>Link Medianya</strong>',
                            icon: 'success',
                            html:
                                `<div class="form-group form-row no-gutters">
                                    <div class="col-10">
                                        <input class="form-control" readonly id="link-media" value="${result}">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-success col" id="copy-button" data-container="body" data-toggle="tooltip" data-placement="top" title="Berhasil dicopy." onclick="copyText()"><i class="fas fa-copy"></i></button>
                                    </div>
                                    <i class="text-sm text-warning mt-2">Link hanya tersedia sekali, setelah ini tidak ada lagi.</i>
                                </div>`,
                            showCloseButton: true,
                            focusConfirm: false,
                            confirmButtonText:
                                '<i class="fa fa-thumbs-up"></i> Oke!',
                            confirmButtonAriaLabel: 'Thumbs up, great!',
                        })
                    },
                    complete: function(){
                        $('#loader').hide();
                    }
                })
            }
        })
        function copyText(){
            $('#link-media').focus();
            $('#link-media').select();
            let result = document.execCommand("copy");
        }
    </script>
@endpush

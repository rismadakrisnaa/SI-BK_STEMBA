<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SIM BK STEMBA">
    <meta name="author" content="RismadaKrisnaAnugrah">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('images/logo-smk-n-5-sby.png') }}" rel="shortcut icon">
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    @livewireStyles
    <style>
        .select2-container .select2-choice, .select2-result-label {
            display: block!important;
            height: 60px!important;
            white-space: nowrap!important;
            line-height: 26px!important;
        }

        .select2-arrow, .select2-chosen {
            padding-top: 6px;
        }

    </style>
</head>

<body id="page-top">
    <input type="hidden" name="base_url" value="{{url('')}}">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            @include('layouts.includes.navbar')
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Top Bar -->
                @include('layouts.includes.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2021</span>
                        <div class="my-2">Sistem Informasi Manajemen Bimbingan Konseling STEMBA</div>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js')}}"></script>

    @include('sweetalert::alert')

    <script>
        $.fn.select2.defaults.set("width", "style");
        $(document).ready(function(){
            var select2 = $('.select2').select2({
                dropdownAutoWidth: true,
                theme: 'default',
                width: '100%'
            });
            $('input[type=file]').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        })
        var table=$('.myDataTable').DataTable({
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
        var base_url = $('input[name=base_url]').val();
    </script>
    @stack('js')
    @livewireScripts
</body>

</html>

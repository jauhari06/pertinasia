<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrator | Dashboard </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <link href="{{ asset('img/'. $page_setting->ikon)}}" rel="icon" />

    <!-- jQuery 2.2.0 -->
    <script src="{{ asset('plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('dist/js/js-lokal.js') }}" language="javascript"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- tanggal -->
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui/jquery-ui.css') }}">
    <script src="{{ asset('jquery-ui/external/jquery/jquery.js') }}"></script>
    <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui/jquery-ui.theme.css') }}">
    <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <style>
        .img_bhs {
            width: 15px;
        }

        .highlight {
    background-color: rgb(255, 0, 0);
}
    </style>
    <script>
        $(function() {
            $("#tgl1").datepicker();
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btn-refresh').addEventListener('click', function() {
        const baseUrl = window.location.origin + window.location.pathname;
        window.location.href = baseUrl;
    });
});
</script>

    <script>
        $(function() {
            $(".tgl2").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        });
        $(function() {
            $(".tgl3").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            });
            $('.time').timepicker({
                showInputs: false,
                showMeridian: false
            });
        });
    </script>

    <script>
        $(function() {

        });
    </script>
   
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin.partials.header')
        @include('admin.partials.menu')
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>


    <div class="control-sidebar-bg"></div>
    </div>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/bindings/inputmask.binding.js') }}"></script>
    <script type="text/javascript">
        $(":input[data-inputmask-alias]").inputmask();
    </script>
    @include('admin.partials.grafik')
</body>

</html>
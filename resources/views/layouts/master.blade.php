<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Quiz System</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{asset('assets/images/logo_barc.png')}}" type="image/x-icon" />

    <link rel="stylesheet" href="{{asset('assets/plugins/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/fontawesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/daterangepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/magnific-popup.css')}}" />
    <link
        href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('assets/sass/style.css')}}" />
    @toastr_css
</head>
<body>
<main class="dashboard_wrapper">

    <!-- Dashboard Menu Section  start-->
    @include('layouts.sidebar')
    <!-- Dashboard Menu Section  end-->

    <!-- Dashboard Content Section start  -->
    @yield('content')
    <!-- Dashboard Content Section end  -->

</main>

<script src="{{asset('assets/plugins/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/js/bootstrap.bundle.min.js')}}"></script>
<script
    src="https://kit.fontawesome.com/46f35fbc02.js"
    crossorigin="anonymous"
></script>
<script src="{{asset('assets/plugins/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/js/chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/plugins/js/moment.min.js')}}"></script>
<!-- <script src="{{'assets/plugins/js/moment.min.js'}}"></script> -->
<script src="{{asset('assets/plugins/js/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/js/jquery.magnific-popup.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="{{asset('assets/js/main.js')}}"></script>


{{--@jquery--}}
@toastr_js
@toastr_render

@stack('script')

</body>
</html>


@if(LaravelLocalization::getCurrentLocale() == 'ar')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
     <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/jqvmap/jqvmap.min.css")}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("adminlte3/dist/css/adminlte.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/daterangepicker/daterangepicker.css")}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/summernote/summernote-bs4.css")}}">
    <!-- Google Font: Source Sans Pro -->
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap 4 RTL -->
     <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">

{{--    <link rel="stylesheet" href="{{asset("css/bootstrap4-rtl.min.css")}}">--}}
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{asset("adminlte3/dist/css/custom.css")}}">
@else
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
     <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("adminlte3/dist/css/adminlte.min.css")}}">
    <!-- Google Font: Source Sans Pro -->
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endif



<style>

    .loader {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #367FA9;
        width: 60px;
        height: 60px;
        -webkit-animation: spin 1s linear infinite; /* Safari */
        animation: spin 1s linear infinite;
    }
</style>

<!-- flag-icon-css -->
<link rel="stylesheet" href="{{asset('adminlte3/plugins/flag-icon-css/css/flag-icon.min.css')}}">


{{--<!-- DataTables -->--}}
{{--<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">--}}
<!-- dropzonejs -->
<link rel="stylesheet" href="{{asset('plugins/dropzone/min/dropzone.min.css')}}">

<link rel="stylesheet" href="{{ asset('adminlte3/custom/morris/morris.css') }}">


@yield('css')

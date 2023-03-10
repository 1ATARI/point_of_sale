<!DOCTYPE html>
<html lang="{{LaravelLocalization::getCurrentLocale()}}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>


@include('includes.stylesheet')

</head>

@if (LaravelLocalization::getCurrentLocale() == 'ar')

    <body class="hold-transition sidebar-mini layout-fixed">
    @else
        <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        @endif
<body class="hold-transition sidebar-mini layout-fixed">
{{--<div class="wrapper">--}}

{{--    <!-- Preloader -->--}}
{{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--        <img class="animation__shake" src={{asset("dist/img/AdminLTELogo.png")}} alt="AdminLTELogo" height="60" width="60">--}}
{{--    </div>--}}

    <!-- Navbar -->
    @include('includes.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('includes.sidebar')
    <!-- Content Wrapper. Contains page content -->

            @yield('content')

    <!-- /.content-wrapper -->
{{--    <!-- Control Sidebar -->--}}
{{--    <aside class="control-sidebar control-sidebar-dark">--}}
{{--        <!-- Control sidebar content goes here -->--}}
{{--    </aside>--}}
    <!-- /.control-sidebar -->
{{--</div>--}}
<!-- ./wrapper -->
        @include('includes.footer')
@include('includes.script')
</body>


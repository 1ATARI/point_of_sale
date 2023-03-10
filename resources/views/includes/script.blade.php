@if (LaravelLocalization::getCurrentLocale() == 'ar')
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset("adminlte3/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset("adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset("adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <!-- AdminLTE3 App -->
    <script src="{{asset("adminlte3/dist/js/adminlte.js")}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset("adminlte3/dist/js/demo.js")}}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{asset("adminlte3/plugins/jquery-mousewheel/jquery.mousewheel.js")}}"></script>
    <script src="{{asset("adminlte3/plugins/raphael/raphael.min.js")}}"></script>
    <script src="{{asset("adminlte3/plugins/jquery-mapael/jquery.mapael.min.js")}}"></script>
    <script src="{{asset("adminlte3/plugins/jquery-mapael/maps/world_countries.min.js")}}"></script>
    <!-- ChartJS -->
    <script src="{{asset("adminlte3/plugins/chart.js/Chart.min.js")}}"></script>

    <!-- PAGE SCRIPTS -->
    <script src="{{asset("adminlte3/dist/js/pages/dashboard2.js")}}"></script>
@else
    <!-- jQuery -->
    <script src="{{asset("adminlte3/plugins/jquery/jquery.min.js")}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset("adminlte3/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 rtl -->
    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- ChartJS -->
    <script src="{{asset("adminlte3/plugins/chart.js/Chart.min.js")}}"></script>
    <!-- Sparkline -->
    <script src="{{asset("adminlte3/plugins/sparklines/sparkline.js")}}"></script>
    <!-- JQVMap -->
    <script src="{{asset("adminlte3/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
    <script src="{{asset("adminlte3/plugins/jqvmap/maps/jquery.vmap.world.js")}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset("adminlte3/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset("adminlte3/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("adminlte3/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset("adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
    <!-- Summernote -->
    <script src="{{asset("adminlte3/plugins/summernote/summernote-bs4.min.js")}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset("adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <!-- AdminLTE3 App -->
    <script src="{{asset("adminlte3/dist/js/adminlte.js")}}"></script>
    <!-- AdminLTE3 dashboard demo (This is only for demo purposes) -->
    <script src="{{asset("adminlte3/dist/js/pages/dashboard.js")}}"></script>
    <!-- AdminLTE3 for demo purposes -->
    <script src="{{asset("adminlte3/dist/js/demo.js")}}"></script>

@endif
<script src="{{ asset("plugins/dropzone/dropzone.js") }}"></script>
{{--<script src="{{asset("js/helpers.js")}}"></script>--}}

<script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>

<script>


    // image preview
    $(".image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });


    CKEDITOR.config.language =  "{{LaravelLocalization::getCurrentLocale()}}";



</script>
<script src="{{asset('adminlte3/custom/custom.js')}}"></script>

<script src="{{asset('adminlte3/custom/jquery.number.js')}}"></script>

<!--print this script-->
<script src="{{asset('adminlte3/custom/printThis.js')}}"></script>

{{--morris --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('adminlte3/custom/morris/morris.min.js') }}"></script>
@yield('js')

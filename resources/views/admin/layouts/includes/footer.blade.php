<footer class="main-footer non-distable text-center d-print-none">
    <strong>جميع الحقوق محفوظة لدي <a href="http://najezsoft.com">NAJEZ SOFT</a> &copy; 2021-2022</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
</footer>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
{{-- <script src="{{ asset('public/admin/dist/js/jquery.min.js') }}"></script> --}}
<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
{{-- <script src="{{ asset('public/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{ asset('public/assets/plugins/all.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@include('admin.layouts.includes.datatable.js')
<!-- overlayScrollbars -->
<script src="{{ asset('public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/assets/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('public/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/assets/dist/js/demo.js') }}"></script>
<script src="{{ asset('public/admin/dist/js/pages/dashboard.js') }}"></script>
<script>
    // .js-example-basic-single declare this class into your select box
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

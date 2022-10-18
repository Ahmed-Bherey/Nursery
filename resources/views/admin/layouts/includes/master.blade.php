<!DOCTYPE html>
<html>
@include('admin.layouts.includes.header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" hidden>
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('admin.layouts.includes.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        @include('admin.layouts.includes.sidebar')

        @yield('content')
        <!-- Content Wrapper. Contains page content -->

        <!-- /.content-wrapper -->
        @include('admin.layouts.includes.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

</body>

</html>

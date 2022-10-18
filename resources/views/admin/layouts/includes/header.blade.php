<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@isset(App\Models\DaycareSettieng::first()->name_ar)
        {{App\Models\DaycareSettieng::first()->name_ar}} | @yield('title')
    @endisset</title>
    <link rel="shortcut icon" href="{{ asset('public/admin/dist/logo.png') }}" type="image/x-icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/assets/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="{{ asset('public/assets/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/dist/css/bootstrap.min.css') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('public/assets/dist/css/bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

    @include('admin.layouts.includes.datatable.css')
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{ asset('public/assets/dist/css/custom.css') }}">
    <script src="{{asset('public/jq.js')}}"></script>

</head>

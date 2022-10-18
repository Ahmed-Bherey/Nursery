<script src="{{ asset('public/admin/dist/js/swal.js') }}"></script>

@if (session()->has('success'))
    <script>
        swal({
            title: " {{ session()->get('success') }}",
            // text: "You clicked the button!",
            icon: "success",
            button: "ok!",
            timer: 2000
        });
    </script>
@endif

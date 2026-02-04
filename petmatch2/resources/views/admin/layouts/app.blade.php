<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PetMatch - {{ $title ?? 'Dashboard' }}</title>

    <link rel="shortcut icon" type="image/png"
          href="https://cdn-icons-png.flaticon.com/512/194/194279.png">

    <link rel="stylesheet" href="{{ asset('template-admin/src/assets/css/styles.min.css') }}">

    <link rel="stylesheet"
          href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css">

    @yield('css')
</head>

<body>

<div class="page-wrapper" id="main-wrapper"
     data-layout="vertical"
     data-navbarbg="skin6"
     data-sidebartype="full"
     data-sidebar-position="fixed"
     data-header-position="fixed">

    @include('admin.layouts.sidebar')

    <div class="body-wrapper">

        @yield('content')

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('template-admin/src/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('template-admin/src/assets/js/app.min.js') }}"></script>
<script src="{{ asset('template-admin/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>

<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@stack('scripts')

<script>
@if (session('success'))
    swal({
        title: "Berhasil",
        text: "{{ session('success') }}",
        icon: "success",
        button: "OK"
    });
@endif

@if (session('error'))
    swal({
        title: "Gagal",
        text: "{{ session('error') }}",
        icon: "error",
        button: "OK"
    });
@endif
</script>

</body>
</html>

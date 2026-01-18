<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PetMatch - {{ $title ?? 'Dashboard' }}</title>

    <!-- FAVICON ONLINE (DOG & CAT) -->
    <link rel="shortcut icon" type="image/png"
          href="https://cdn-icons-png.flaticon.com/512/194/194279.png">

    <!-- TEMPLATE CSS (LOCAL) -->
    <link rel="stylesheet" href="{{ asset('template-admin/src/assets/css/styles.min.css') }}">

    <!-- DATATABLE CSS CDN -->
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

    <!-- SIDEBAR -->
    @include('admin.layouts.sidebar')

    <div class="body-wrapper">

        <!-- HEADER -->
       

        <!-- CONTENT -->
        {{-- <div class="container-fluid">
        </div> --}}
        @yield('content')

    </div>
</div>

<!-- ================= JAVASCRIPT ================= -->

<!-- JQUERY CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- BOOTSTRAP CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- TEMPLATE JS (LOCAL – WAJIB) -->
<script src="{{ asset('template-admin/src/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('template-admin/src/assets/js/app.min.js') }}"></script>
<script src="{{ asset('template-admin/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>

<!-- DATATABLE JS CDN -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

<!-- SWEETALERT CDN -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@yield('js')

<!-- SWEETALERT SESSION -->
<script>
@if (session('status'))
    swal({
        title: "{{ session('title') }}",
        text: "{{ session('message') }}",
        icon: "{{ session('status') }}",
        button: "OK"
    });
@endif
</script>

</body>
</html>

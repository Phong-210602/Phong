<!DOCTYPE html>
<html>
<head>
<title>@yield('title', 'Trang chủ')</title>
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- Summernote CSS for Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

</head>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary"> <!--begin::App Wrapper-->
  <div class="app-wrapper"> <!--begin::Header-->
    
    @include('partials.sidebar')
    @include('partials.navbar')
    @include('partials.footer')

<!-- Thêm AdminLTE JS -->
{{-- <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Summernote JS (lite, tương thích BS5) -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

@yield('scripts')
</body>

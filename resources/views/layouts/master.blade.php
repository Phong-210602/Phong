<!DOCTYPE html>
<html>
<head>
<title>@yield('title', 'Đăng nhập')</title>
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container-fluid">
        @yield('content')
    </div>
    
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    
</body>
</html>
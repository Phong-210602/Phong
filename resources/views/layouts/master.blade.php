<!-- filepath: c:\Users\nguye\OneDrive\Desktop\Phong\laravel2\resources\views\layouts\master.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Trang chủ')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
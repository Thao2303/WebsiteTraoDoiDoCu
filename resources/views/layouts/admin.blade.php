<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tài Khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            background-color: #343a40;
            color: white;
            width: 250px;
            position: fixed;
            height: 100vh;
            padding-top: 20px;
            padding-left: 15px;
        }

        .sidebar h4 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #575757;
            padding-left: 30px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .breadcrumb-nav {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
        }

        .breadcrumb-nav .breadcrumb {
            margin-bottom: 0;
        }

        .container {
            margin-top: 20px;
        }

        /* Small screen responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .sidebar a {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center">Admin Dashboard</h4>
    
    <a href="{{ route('categories.index') }}">Quản lí bài đăng</a>
    <a href="{{ route('posts.index') }}">Quản lí danh mục</a>
    <a href="{{ route('admin.index') }}">Quản lí tài khoản</a>
    <a href="#">Chức Năng 4</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Breadcrumb Nav -->
    <div class="breadcrumb-nav">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quản lý Tài Khoản</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        @yield('content')
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

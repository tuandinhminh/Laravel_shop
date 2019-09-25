
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang admin</title>
    <base href="{{asset('')}}">
    <!-- Custom fonts for this template-->
    <link href="admin_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="admin_assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin_assets/css/sb-admin.css" rel="stylesheet">

    <script type="text/javascript" src="admin_assets/js/jquery-3.4.1.min.js"></script>
</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Start Bootstrap</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
                @if(Auth::check())
                    {{Auth::user()->full_name}}
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logoutadmin')}}" >Logout</a>
            </div>
        </li>
    </ul>

</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">

        <li class="nav-item ">
            <a class="nav-link" href="{{route('danhsachloaisp')}}">
                <i class="fas fa-th-list"></i>
                <span>Loại sản phẩm</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="{{route('danhsachproduct')}}">
                <i class="fab fa-product-hunt"></i>
                <span>Sản phẩm</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="{{route('danhsachuser')}}">
                <i class="fas fa-users-cog"></i>
                <span>User</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link" href="{{route('danhsachbill')}}">
                <i class="fas fa-receipt"></i>
                <span>Quản lý đơn hàng</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link" href="{{route('danhsachslide')}}">
                <i class="fab fa-slideshare"></i>
                <span>Slide</span>
            </a>
        </li>

    </ul>

    <div id="content-wrapper">

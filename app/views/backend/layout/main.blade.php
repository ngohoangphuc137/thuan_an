<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin-Thuận an</title>

    @include('backend.layout.linkcss')

</head>

<body class="hold-transition sidebar-mini layout-fixed">  
    <div class="wrapper">

        <!-- Preloader -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin/dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="{{ route('admin/logout') }}" role="button">
                        Đăng xuất
                    </a>
                </li>
                <!-- Messages Dropdown Menu -->
             
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <span class="brand-text font-weight-light" style="margin-left: 15px;">Xin chào Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- <img src="" class="img-circle elevation-2" alt="User Image"> -->
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('admin/dashboard') }}" class="nav-link"> 
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Bảng điều khiển</p>
                            </a>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a  class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Quản lý sản phẩm
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin/category') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh mục</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin/product') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách sản phẩm</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin/moreProduct') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm sản phẩm</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin/listUser') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Quản lý khách hàng

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin/ordel') }}" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Quản lý đơn hàng    
                                </p>
                            </a>
                         
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin/comment') }}" class="nav-link">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>
                                    Quản lý bình luận
                                   
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                            <i class="nav-icon fas fa-layer-group"></i>
                                <p>
                                    layout page
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin/homeLayoutUser')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Home
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a  class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Bài viết
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('admin/listPost') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Tất cả bài viết</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin/morePost') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Thêm bài viết mới</p>
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </li>
                              
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- phần page động -->
        <div class="content-wrapper">
            @yield('content')
        </div>


        <footer class="main-footer">
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('backend.layout.linkjs')
</body>
</html>
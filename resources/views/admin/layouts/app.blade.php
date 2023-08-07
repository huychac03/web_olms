<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','Trang Quản Trị')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('common/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/components/datatables.net-bs/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/components/select2/dist/css/select2.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/main.css') }}">
    <script src="{!! asset('admin/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('admin/ckfinder/ckfinder.js') !!}"></script>
    <script src="{!! asset('admin/dist/js/func_ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/')!!}"
    </script>
    <![endif]-->
    <!-- Google Font -->
    @yield('style')
    <style>
        .main_content { margin-top: 20px}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>D</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b> </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"><i class="fa fa-fw fa-sign-out"></i> </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    Tên tài khoản : {{ \Auth::user() ? \Auth::user()->name : '' }}
                                    <small>Email : {{ \Auth::user() ? \Auth::user()->name : '' }} </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    {{--<a href="" class="btn btn-default btn-flat">Thông tin tài khoản</a>--}}
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->

    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu navigation" data-widget="tree">
                @php
                    if(!isset(\Auth::user()->level)) {
                        return redirect()->route('admin.logout');
                    }
                    $level = \Auth::user()->level
                @endphp
                @if($level == 1 || $level == 2 | $level == 3)
                <li class="{{ isset($home) ? 'active menu-open' : '' }}"><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> <span>Bảng điều khiển</span></a></li>
                @endif
                @if($level == 2 | $level == 3)
                <li class="{{ isset($category_menu) ? 'active menu-open' : '' }}"><a href="{{ route('admin.category.index') }}"><i class="fa fa-folder-o"></i> <span>Chuyên mục</span></a></li>
                @endif
                @if($level == 2 | $level == 3)
                <li class="{{ isset($author_menu) ? 'active menu-open' : '' }}"><a href="{{ route('admin.author.index') }}"><i class="fa fa-user"></i> <span>Tác giả</span></a></li>
                @endif
                @if($level == 1 || $level == 2 | $level == 3)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book fa-fw"></i>
                        <span>Truyện</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.story.index') }}"><i class="fa fa-circle-o"></i> Danh sách truyện</a></li>
                        <li><a href="{{ route('admin.chapter.index') }}"><i class="fa fa-circle-o"></i> Danh sách chương</a></li>
                        <li><a href="{{ route('admin.story.create') }}"><i class="fa fa-circle-o"></i> Thêm mới truyện</a></li>
                        @if(isset($story))
                        <li style="display: none"><a href="{{ route('admin.story.update', $story->id) }}"><i class="fa fa-circle-o"></i></a></li>
                        <li style="display: none"><a href="{{ route('admin.chapter.create', $story->id) }}"><i class="fa fa-circle-o"></i></a></li>
                        @endif
                        @if(isset($chapters) && isset($story))
                        <li style="display: none"><a href="{{ route('admin.chapter.list', $story->id) }}"><i class="fa fa-circle-o"></i></a></li>
                        @endif
                        @if(isset($chapter))
                        <li style="display: none"><a href="{{ route('admin.chapter.update', $chapter->id) }}"><i class="fa fa-circle-o"></i></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if($level == 3)
                <li class="{{ isset($user_menu) ? 'active menu-open' : '' }}"><a href="{{ route('admin.user.index') }}"><i class="fa fa-lock fa-fw"></i> Thành viên</a></li>
                <li class="{{ isset($settings) ? 'active menu-open' : '' }}"><a href="{{ route('admin.setting.index') }}"><i class="fa fa-cog"></i> Cài đặt hệ thống</a></li>
{{--                <li><a href="{{ route('admin.setting.ads') }}"><i class="fa fa-money"></i> Quản lý quảng cáo</a></li>--}}
                <li><a href="{{ route('admin.setting.tos') }}"><i class="fa fa-pencil"></i> Chỉnh sửa điều khoản</a></li>
{{--                <li><a href="{{ route('admin.leech') }}"><i class="fa fa-pencil"></i> Leech Tool</a></li>--}}
                @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height: 1300px;">
        @include('admin.layouts.alert')
        @yield('content')
    <!-- Content Header (Page header) -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2020-2020 <a href="">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{ asset('common/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('common/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('admin/components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('admin/components/datatables.net/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/components/datatables.net-bs/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('admin/components/select2/dist/js/select2.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script src="{{ asset('admin/dist/js/main.js') }}"></script>
@yield('script')

</body>
</html>


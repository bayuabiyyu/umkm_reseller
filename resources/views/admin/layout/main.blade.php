<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title> {{ env('APP_NAME', 'Laravel') }} | Admin @yield('pageName')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin') }}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @stack('css')
</head>
{{-- Transaction = Hide Sidebar --}}
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed {{ request()->segment(2) == "transaction" ? "sidebar-collapse" : "" }}">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
<!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('assets/admin') }}/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('assets/admin') }}/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('assets/admin') }}/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ env('APP_NAME', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/admin') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Main Menu</li>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link"> &nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.unit.index') }}" class="nav-link"> &nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.product.index') }}" class="nav-link"> &nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.supplier.index') }}" class="nav-link"> &nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link"> &nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Transaction
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.transaction.sale.index') }}" class="nav-link"> &nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales / Direct</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"> &nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchases / Direct </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"> &nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders / Via Website</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="nav-header">Account</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Information</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Setting</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#">Ahmad Husain Abiyyu</a> | BiySoft.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> Development 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/admin') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin') }}/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('assets/admin') }}/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('assets/admin') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/admin') }}/plugins/chart.js/Chart.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('assets/admin') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Toastr -->
<script src="{{ asset('assets/admin') }}/plugins/toastr/toastr.min.js"></script>
<!-- Global JS -->
<script src="{{ asset('assets/admin/global') }}/global.js"></script>

@stack('javascript')

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - SIMPEG Asy-Syakiriyah Jati</title>

    <!-- Google Font: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style (AdminLTE) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS Premium Theme - Pesantren Green & Gold -->
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #F8FAFC !important;
        }
        .content-wrapper {
            background-color: #F8FAFC !important;
            padding-bottom: 30px;
        }
        
        /* Brand Sidebar Customization - Deep Green & Gold */
        .main-sidebar {
            background: linear-gradient(180deg, #022C22 0%, #064E3B 100%) !important; /* Islamic Deep Emerald */
            box-shadow: 0 10px 30px 0 rgba(0,0,0,0.15);
        }
        .brand-link {
            border-bottom: 1px solid rgba(251, 191, 36, 0.15) !important;
            background-color: #022C22 !important;
            color: #FFFFFF !important;
            font-weight: 600;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active,
        .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important; /* Emerald active state */
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(4, 120, 87, 0.3);
            border-left: 3px solid #FBBF24; /* Gold left border */
            border-radius: 8px;
        }
        .nav-link {
            border-radius: 8px;
            margin: 2px 8px;
            transition: all 0.2s ease;
            font-weight: 500;
            color: #E2E8F0 !important;
        }
        .nav-link:hover {
            background-color: rgba(255,255,255,0.06) !important;
            color: #FBBF24 !important; /* Hover with gold */
        }
        .nav-link.active:hover {
            color: #fff !important;
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
        }
        .nav-header {
            color: rgba(251, 191, 36, 0.5) !important; /* Gold header */
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding-left: 20px !important;
        }

        /* Buttons & Badges Customization to Green & Gold */
        .btn-primary {
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
            border: none !important;
            font-weight: 500;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(4, 120, 87, 0.2);
            transition: all 0.2s ease;
            color: #fff !important;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #047857 0%, #064E3B 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(4, 120, 87, 0.3);
        }
        .btn-success {
            background-color: #10B981 !important;
            border-color: #10B981 !important;
            font-weight: 500;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
            transition: all 0.2s ease;
        }
        .btn-success:hover {
            background-color: #059669 !important;
            border-color: #059669 !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(16, 185, 129, 0.3);
        }
        .btn-danger {
            background-color: #EF4444 !important;
            border-color: #EF4444 !important;
            font-weight: 500;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);
            transition: all 0.2s ease;
        }
        .btn-danger:hover {
            background-color: #DC2626 !important;
            border-color: #DC2626 !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(239, 68, 68, 0.3);
        }
        .btn-info {
            background: linear-gradient(135deg, #FBBF24 0%, #D97706 100%) !important; /* Gold gradient for Info */
            border: none !important;
            color: #fff !important;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.2);
        }
        .btn-info:hover {
            background: linear-gradient(135deg, #D97706 0%, #B45309 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(217, 119, 6, 0.3);
        }
        .btn-warning {
            border-radius: 8px;
            color: #fff !important;
        }
        .btn-secondary {
            border-radius: 8px;
        }

        /* Color Overrides for tables & texts */
        .text-primary {
            color: #047857 !important;
        }
        .bg-primary-light {
            background-color: #047857 !important;
        }
        .bg-success-light {
            background-color: #10B981 !important;
        }
        .bg-warning-light {
            background-color: #F59E0B !important;
        }
        .bg-info-light {
            background-color: #D97706 !important;
        }
        
        /* Card custom styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #FFFFFF;
            border-bottom: 1px solid #F1F5F9;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            font-weight: 600;
            color: #1E293B;
            padding: 15px 20px;
        }
        .card-body {
            padding: 20px;
        }

        /* Breadcrumb Customization */
        .breadcrumb-item a {
            color: #047857;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #64748B;
        }

        /* User profile dropdown */
        .user-panel img {
            object-fit: cover;
            width: 34px;
            height: 34px;
        }
        
        /* Custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(251, 191, 36, 0.2);
            border-radius: 4px;
        }
    </style>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-secondary" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- User Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center text-dark" data-toggle="dropdown" href="#">
                    <div class="image mr-2">
                        <i class="fa-solid fa-circle-user fa-lg text-success"></i>
                    </div>
                    <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                    <i class="fas fa-angle-down ml-2 text-muted"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded-lg shadow border-0">
                    <span class="dropdown-header font-weight-bold text-left">{{ Auth::user()->name }}</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fas fa-user-cog mr-2 text-success"></i> Pengaturan Profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item text-danger font-weight-bold"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar Aplikasi
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-0">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link text-center d-block py-3">
            <span class="brand-text font-weight-bold text-lg"><i class="fa-solid fa-mosque mr-2 text-warning"></i>ASY-SYAKIRIYAH</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar px-2">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center border-bottom border-secondary" style="border-bottom-color: rgba(251, 191, 36, 0.15) !important;">
                <div class="image ml-2">
                    <div class="bg-warning text-dark d-flex align-items-center justify-content-center rounded-circle font-weight-bold" style="width: 36px; height: 36px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                </div>
                <div class="info ml-2">
                    <a href="#" class="d-block font-weight-bold text-white mb-0" style="font-size: 0.9rem;">{{ Auth::user()->name }}</a>
                    <span class="badge text-xs {{ Auth::user()->role === 'admin' ? 'bg-warning text-dark' : 'bg-success text-white' }} text-capitalize px-2 py-1" style="font-size: 0.7rem; font-weight: bold;">
                        {{ Auth::user()->role }}
                    </span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-header">Utama</li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">Data Kepegawaian</li>
                    <li class="nav-item">
                        <a href="{{ route('pegawai.index') }}" class="nav-link {{ Route::is('pegawai.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Pegawai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jabatan.index') }}" class="nav-link {{ Route::is('jabatan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Jabatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('riwayat.index') }}" class="nav-link {{ Route::is('riwayat.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Pekerjaan</p>
                        </a>
                    </li>

                    @if(Auth::user()->role === 'admin')
                    <li class="nav-header">Keamanan & User</li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>User Pengguna</p>
                        </a>
                    </li>
                    @endif

                    <li class="nav-header">Pelaporan</li>
                    <li class="nav-item">
                        <a href="{{ route('laporan.index') }}" class="nav-link {{ Route::is('laporan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>Laporan Kepegawaian</p>
                        </a>
                    </li>

                    <li class="nav-item mt-4">
                        <!-- Logout Form inside sidebar -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="nav-link text-danger"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p class="font-weight-bold">Logout</p>
                            </a>
                        </form>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header pt-4">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.75rem;">@yield('page_title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer bg-white border-top-0 py-3 shadow-sm text-center">
        <strong>Copyright &copy; 2026 <a href="#">Pondok Pesantren Asy-Syakiriyah Jati</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- DataTables & Plugins -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<!-- Global Toast Alert setup -->
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        });
    @endif

    @if(session('error'))
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        });
    @endif
</script>

@yield('scripts')
</body>
</html>

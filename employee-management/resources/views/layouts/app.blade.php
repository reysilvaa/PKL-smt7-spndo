<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Karyawan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @auth
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="min-height: 100vh;">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="fas fa-home me-2"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                                    <i class="fas fa-users me-2"></i>Data Karyawan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                                    <i class="fas fa-building me-2"></i>Data Departemen
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#reportSubmenu">
                                    <i class="fas fa-chart-bar me-2"></i>Laporan <i class="fas fa-chevron-down ms-2"></i>
                                </a>
                                <ul class="collapse nav flex-column ms-3" id="reportSubmenu">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('reports.employee_list') ? 'active' : '' }}" href="{{ route('reports.employee_list') }}">
                                            <i class="fas fa-list me-2"></i>Daftar Karyawan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('reports.status_summary') ? 'active' : '' }}" href="{{ route('reports.status_summary') }}">
                                            <i class="fas fa-chart-pie me-2"></i>Ringkasan Status
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('reports.status_by_department') ? 'active' : '' }}" href="{{ route('reports.status_by_department') }}">
                                            <i class="fas fa-chart-line me-2"></i>Status per Departemen
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item mt-5">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger w-100" type="submit">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Main content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">@yield('title', 'Dashboard')</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            @yield('buttons')
                        </div>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @yield('content')
                </main>
            @else
                <main class="col-12">
                    @yield('content')
                </main>
            @endauth
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple JavaScript for enhancing the UI experience
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
    @yield('scripts')
</body>
</html> 
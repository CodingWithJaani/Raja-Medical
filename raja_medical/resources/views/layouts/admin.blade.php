<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Raja Medical')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        .sidebar {
            background-color: #343a40;
            min-height: calc(100vh - 56px);
        }
        
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 0.75rem 1rem;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: #495057;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        
        .main-content {
            margin-left: 0;
        }
        
        @media (min-width: 768px) {
            .main-content {
                margin-left: 250px;
            }
        }
        
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .stats-card h3 {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="/images/logo.svg" alt="Raja Medical" height="32" class="me-2">
                <span class="text-light">Admin</span>
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> View Site
                </a>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar position-fixed d-none d-md-block" style="width: 250px;">
            <nav class="nav flex-column p-3">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" 
                   href="{{ route('admin.products.index') }}">
                    <i class="bi bi-box"></i> Products
                </a>
                
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                   href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-tags"></i> Categories
                </a>
                
                <a class="nav-link {{ request()->routeIs('admin.queries') ? 'active' : '' }}" 
                   href="{{ route('admin.queries') }}">
                    <i class="bi bi-chat-dots"></i> Customer Queries
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <div class="container-fluid p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>
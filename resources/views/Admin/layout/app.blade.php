<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>naturolia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: "Poppins", sans-serif;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #7a1f0b, #a43f26);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            transition: all 0.3s ease;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            font-size: 1.6rem;
            font-weight: 700;
            padding: 1.5rem;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            margin: 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link {
            color: #eee;
            padding: 0.9rem 1.5rem;
            border-radius: 8px;
            margin: 0.3rem 1rem;
            font-size: 0.80rem;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #fff;
            color: #a43f26;
            font-weight: 600;
        }

        /* Content */
        .content {
            margin-left: 250px;
            padding: 2rem;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            padding: 1rem 2rem;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h4 {
            font-size: 1.3rem;
            color: #333;
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
        }

        .topbar .user-info img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            margin-right: 12px;
            border: 2px solid #a43f26;
        }

        /* Dropdown styling */
        .collapse .nav-link {
            padding-left: 2.5rem !important;
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }
    </style>

    @stack('styles')
</head>

<body>
    @php
        $currentRoute = Route::currentRouteName();
    @endphp

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <h2>Naturolia</h2>
        <nav class="nav flex-column mt-3">
            <a href="{{ route('Admin.Dashboard') }}"
                class="nav-link {{ $currentRoute == 'Admin.Dashboard' ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>

<div class="nav-item">
    <a class="nav-link d-flex justify-content-between align-items-center" href="#productsSubmenu"
        data-bs-toggle="collapse" role="button"
        aria-expanded=""
        aria-controls="productsSubmenu">
        <span><i class="bi bi-box-seam me-2"></i> Products</span>
        <i class="bi bi-caret-down-fill"></i>
    </a>

    <div class="collapse ps-3 "
         id="productsSubmenu">

        <a href="{{ route('admin.products.create') }}"
           class="nav-link py-1">
            <i class="bi bi-plus-circle me-2"></i> Create Product
        </a>

        <a href="{{ route('admin.products.index') }}"
           class="nav-link py-1 ">
            <i class="bi bi-list-ul me-2"></i> View Products
        </a>

    </div>
</div>
<div class="nav-item">
    <a class="nav-link d-flex justify-content-between align-items-center" href="#userAdminSubmenu"
        data-bs-toggle="collapse" role="button"
        aria-expanded=""
        aria-controls="userAdminSubmenu">
        <span><i class="bi bi-person-lines-fill me-2"></i> User Management</span>
        <i class="bi bi-caret-down-fill"></i>
    </a>

    <div class="collapse ps-3" id="userAdminSubmenu">

       
        <a href="{{ route('admin.user.index') }}"
           class="nav-link py-1">
            <i class="bi bi-person-circle me-2"></i> Customer 
        </a>
        <a href="{{ route('admin.admin.index') }}"
           class="nav-link py-1">
            <i class="bi bi-person-badge me-2"></i> Admin
        </a>

    </div>
</div>
<div class="nav-item">
    <a class="nav-link d-flex justify-content-between align-items-center" href="#orderManagementSubmenu"
        data-bs-toggle="collapse" role="button" aria-expanded="" aria-controls="orderManagementSubmenu">
        <span><i class="bi bi-cart-fill me-2"></i> Order Management</span>
        <i class="bi bi-caret-down-fill"></i>
    </a>

    <div class="collapse ps-3" id="orderManagementSubmenu">
        <a href="{{ route('admin.orders.pending') }}" class="nav-link py-1">
            <i class="bi bi-clock me-2"></i> Pending Orders
        </a>
        <a href="{{ route('admin.orders.completed') }}" class="nav-link py-1">
            <i class="bi bi-check-circle me-2"></i> Completed Orders
        </a>
          <a href="{{ route('admin.orders.cancelled') }}" class="nav-link py-1">
            <i class="bi bi-x-circle me-2"></i> Cancelled Orders
        </a>
         <a href="{{ route('admin.returns.request') }}" class="nav-link py-1">
    <i class="bi bi-x-circle me-2"></i> Return Requests
</a>

        <a href="{{ route('admin.orders.all') }}" class="nav-link py-1">
            <i class="bi bi-list me-2"></i> All Orders
        </a>
    </div>
</div>


            <a href="{{route('admin.settings')}}" class="nav-link"><i class="bi bi-gear me-2"></i> Settings</a> 
        </nav>

        <div class="mt-auto p-3">
           <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn w-100 fw-semibold"
            style="background-color: #fff; color:#a43f26; border-radius:10px;">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar">
    <h4 class="fw-bold text-dark">@yield('page-title', 'Dashboard')</h4>
    <div class="user-info">
        <!-- Display Profile Image -->
        <img src="{{ asset(Auth::user()->profile_image ?? 'profile_images/default-avatar.png') }}" alt="User" class="rounded-circle" width="40">
        <span class="fw-bold">{{ Auth::user()->name }}</span> <!-- Display admin name -->
    </div>
</div>


        <!-- Page Content -->
        <div>
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>

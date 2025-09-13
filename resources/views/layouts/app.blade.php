<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #1e293b;
            color: white;
            overflow-y: auto;
        }

        .sidebar .brand {
            font-size: 1.4rem;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
            background: #0f172a;
        }

        .sidebar .nav-link {
            color: #cbd5e1;
            font-size: 15px;
            padding: 5px 20px;
            border-radius: 8px;
            margin: 4px 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link:hover {
            background: #334155;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #3b82f6;
            color: #fff;
            font-weight: 600;
        }

        .main-content {
            margin-left: 240px;
            padding: 30px;
            min-height: 100vh;
        }

        .nav-icon {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <i class="bi bi-box-seam" style="margin-right: 7px,back"></i> Inventory 
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}" href="{{ route('items.index') }}">
                    <i class="bi bi-box nav-icon"></i> Items Master
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                    <i class="bi bi-people nav-icon"></i> Employee
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('business_partners.*') ? 'active' : '' }}" href="{{ route('business_partners.index') }}">
                    <i class="bi bi-briefcase nav-icon"></i> Business Partner
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('business_places.*') ? 'active' : '' }}" href="{{ route('business_places.index') }}">
                    <i class="bi bi-building nav-icon"></i> Business Place
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('warehouses.*') ? 'active' : '' }}" href="{{ route('warehouses.index') }}">
                    <i class="bi bi-house-gear nav-icon"></i> Warehouse
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('goods_receipts.*') ? 'active' : '' }}" href="{{ route('goods_receipts.index') }}">
                    <i class="bi bi-bag-plus nav-icon"></i> Goods Receipt
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('goods_issues.*') ? 'active' : '' }}" href="{{ route('goods_issues.index') }}">
                    <i class="bi bi-bag-dash nav-icon"></i> Goods Issue
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('inventory_counts.*') ? 'active' : '' }}" href="{{ route('inventory_counts.index') }}">
                    <i class="bi bi-clipboard-check nav-icon"></i> Inventory Count
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>

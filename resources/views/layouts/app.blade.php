<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
   <style>
    .sidebar {
        width: 240px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: #1e293b;
        color: white;
        overflow-y: auto;
        transition: width 0.3s ease; /* smooth animation */
    }

    .sidebar.collapsed {
        width: 85px; /* collapsed width */
    }

    .sidebar .brand {
        cursor: pointer;
        font-size: 1.4rem;
        font-weight: bold;
        text-align: center;
        padding: 20px 0;
        background: #0f172a;
        white-space: nowrap;
        transition: opacity 0.3s ease;
    }

    .sidebar.collapsed .brand span {
        opacity: 0; /* hide text when collapsed */
    }
 .sidebar.collapsed .brand i {
      padding: 0;
      padding-left: 30px
    }
    .sidebar .nav-link {
        color: #cbd5e1;
        font-size: 15px;
        padding: 8px 20px;
        border-radius: 8px;
        margin: 4px 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s ease-in-out;
        white-space: nowrap;
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

    /* 👇 hide text when collapsed */
    .sidebar.collapsed .nav-link span {
        display: none;
    }

    /* 👇 center icon when collapsed */
    .sidebar.collapsed .nav-link {
        justify-content: center;
        gap: 0;
        padding: 10px;
    }

    .main-content {
        margin-left: 240px;
        padding: 30px;
        min-height: 100vh;
        transition: margin-left 0.3s ease;
    }

    .sidebar.collapsed ~ .main-content {
        margin-left: 85px; /* match collapsed width */
    }

    .nav-icon {
        font-size: 1.2rem;
    }

    /* Toggle button */
    .toggle-btn {
        position: absolute;
        top: 15px;
        right: 0px;
        background: #3b82f6;
        border-radius: 50%;
        color: white;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.3s ease;
        z-index: 9999;
    }
.sidebar.collapsed .toggle-btn {
    right: 30px; /* position inside when collapsed */
    transform: rotate(180deg);
}

    .sidebar.collapsed .toggle-btn {
        transform: rotate(180deg);
    }
</style>

</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand" id="toggle-btn">
            <i class="bi bi-box-seam"></i> <span>Inventory</span>  
        </div>
        {{-- <div class="toggle-btn" id="toggle-btn">
            <i class="bi bi-chevron-left"></i>
        </div> --}}
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}" href="{{ route('items.index') }}">
                    <i class="bi bi-box nav-icon"></i> <span>Items Master</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                    <i class="bi bi-people nav-icon"></i> <span>Employee</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('business_partners.*') ? 'active' : '' }}" href="{{ route('business_partners.index') }}">
                    <i class="bi bi-briefcase nav-icon"></i> <span>Business Partner</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('business_places.*') ? 'active' : '' }}" href="{{ route('business_places.index') }}">
                    <i class="bi bi-building nav-icon"></i> <span>Business Place</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('warehouses.*') ? 'active' : '' }}" href="{{ route('warehouses.index') }}">
                    <i class="bi bi-house-gear nav-icon"></i> <span>Warehouse</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('goods_receipts.*') ? 'active' : '' }}" href="{{ route('goods_receipts.index') }}">
                    <i class="bi bi-bag-plus nav-icon"></i> <span>Goods Receipt</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('goods_issues.*') ? 'active' : '' }}" href="{{ route('goods_issues.index') }}">
                    <i class="bi bi-bag-dash nav-icon"></i> <span>Goods Issue</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('inventory_counts.*') ? 'active' : '' }}" href="{{ route('inventory_counts.index') }}">
                    <i class="bi bi-clipboard-check nav-icon"></i> <span>Inventory Count</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

 <script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-btn');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        // 👇 Keep collapsed state in localStorage so it doesn't reset
        if (sidebar.classList.contains('collapsed')) {
            localStorage.setItem('sidebar', 'collapsed');
        } else {
            localStorage.setItem('sidebar', 'expanded');
        }
    });

    // 👇 Restore state on page load
    window.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('sidebar') === 'collapsed') {
            sidebar.classList.add('collapsed');
        }
    });
</script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
 <style>
           
.readonly {
    background-color: #24303c;
    pointer-events: none;
}

        </style>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width: 220px; height: 100vh;">
            <h4>Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('items.index') }}">Items</a></li>
             <li class="nav-item"><a class="nav-link text-white" href="{{ route('employees.index') }}">Employee</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('business_partners.index') }}">Business Partner</a></li>
             <li class="nav-item"><a class="nav-link text-white" href="{{ route('business_places.index') }}">Business Place</a></li>

             <li class="nav-item"><a class="nav-link text-white" href="{{ route('warehouses.index') }}">Warehouse</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('goods_receipts.index') }}">Goods Receipt</a></li>
                <li class="nav-item"><a class="nav-link text-white"href="{{ route('goods_issues.index') }}">Goods Issue</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('inventory_counts.index') }}">Inventory Count</a></li>
             
            </ul>
        </div>

        <!-- Main Content -->
        <div class="p-4 flex-grow-1">
            @yield('content')
        </div>
    </div>
</body>
</html>

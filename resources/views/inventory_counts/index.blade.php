@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="border p-3 rounded mb-5 bg-white">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary"><i class="bi bi-card-list"></i> Inventory Counts</h2>
        <a href="{{ route('inventory_counts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Count
        </a>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter Form --}}
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-2">
            <input type="text" name="number" class="form-control" placeholder="Count #" value="{{ request('number') }}">
        </div>
        <div class="col-md-2">
            <select name="employee_id" class="form-select">
                <option value="">All Employees</option>
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                        {{ $emp->first_name }} {{ $emp->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="warehouse_id" class="form-select">
                <option value="">All Warehouses</option>
                @foreach($warehouses as $wh)
                    <option value="{{ $wh->id }}" {{ request('warehouse_id') == $wh->id ? 'selected' : '' }}>
                        {{ $wh->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100"><i class="bi bi-search"></i> Filter</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('inventory_counts.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-circle"></i> Reset</a>
        </div>
    </form>
 </div>
    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Number</th>
                            <th>Count Date</th>
                            <th>Count Time</th>
                            <th>Count Type</th>
                            <th>Counted By</th>
                            <th>Status</th>
                            <th>Warehouse</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($counts as $count)
                        <tr class="text-center">
                            <td>{{ $loop->iteration + ($counts->currentPage()-1)*$counts->perPage() }}</td>
                            <td>{{ $count->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($count->count_date)->format('d M, Y') }}</td>
                            <td>{{ $count->count_time }}</td>
                            <td>{{ $count->count_type ?? '-' }}</td>
                            <td>{{ $count->inventory_counter_user ?? '-' }}</td>
                            <td>{{ $count->status }}</td>
                            <td>{{ $count->warehouse->name ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('inventory_counts.edit', $count) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('inventory_counts.destroy', $count) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this count?')">
                                        <i class="bi bi-trash3"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No inventory counts found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end mt-3">
        {{ $counts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="border p-3 rounded mb-5 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-building"></i> Warehouses List
            </h2>
            <a href="{{ route('warehouses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New
            </a>
        </div>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ✅ Optional Filter/Search --}}
        <form method="GET" action="{{ route('warehouses.index') }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by code or name" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('warehouses.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            </div>
        </form>
    </div>

    {{-- ✅ Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Warehouse Code</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Manager</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warehouses as $warehouse)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $warehouse->code }}</td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->location ?? '-' }}</td>
                                <td>{{ $warehouse->manager ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('warehouses.edit', $warehouse) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this warehouse?')">
                                            <i class="bi bi-trash3"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No warehouses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ✅ Pagination --}}
    <div class="d-flex justify-content-end mt-4">
        {{-- If you paginate, replace $warehouses->links() --}}
        {{ $warehouses->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

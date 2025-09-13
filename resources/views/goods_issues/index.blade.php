@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="border p-3 rounded mb-5 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-receipt"></i> Goods Issues
            </h2>
            <a href="{{ route('goods_issues.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> New Issue
            </a>
        </div>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ✅ Filter/Search --}}
        <form method="GET" action="{{ route('goods_issues.index') }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by number or employee" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="warehouse" class="form-select">
                    <option value="">All Warehouses</option>
                    @foreach($warehouses as $wh)
                        <option value="{{ $wh->id }}" {{ request('warehouse') == $wh->id ? 'selected' : '' }}>
                            {{ $wh->code }} - {{ $wh->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('goods_issues.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Number</th>
                            <th>Document Date</th>
                            <th>Employee</th>
                            <th>Warehouse</th>
                            <th>Truck No</th>
                            <th>Ship To</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($issues as $issue)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="fw-semibold">{{ $issue->number }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($issue->document_date)->format('d-M-Y') }}</td>
                                <td>{{ $issue->employee->first_name ?? '-' }}</td>
                                <td>{{ $issue->warehouse->name ?? '-' }}</td>
                                <td>{{ $issue->truck_no ?? '-' }}</td>
                                <td>{{ $issue->ship_to ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('goods_issues.edit', $issue->id) }}" class="btn btn-sm btn-outline-warning me-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('goods_issues.destroy', $issue->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this issue?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash3"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No issues found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ✅ Pagination --}}
    <div class="d-flex justify-content-end mt-4">
        {{ $issues->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

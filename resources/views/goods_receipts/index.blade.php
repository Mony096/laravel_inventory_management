@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="border p-3 rounded mb-5 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary"><i class="bi bi-receipt"></i> Goods Receipts</h2>
        <a href="{{ route('goods_receipts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Receipt
        </a>
    </div>

    {{-- Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter --}}
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-2">
            <input type="text" name="number" class="form-control" placeholder="Receipt #" value="{{ request('number') }}">
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
            <select name="supplier" class="form-select">
                <option value="">All Suppliers</option>
                @foreach($partners as $pn)
                    <option value="{{ $pn->id }}" {{ request('supplier') == $pn->id ? 'selected' : '' }}>
                        {{ $pn->CardName }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100"><i class="bi bi-search"></i> Filter</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('goods_receipts.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-circle"></i> Reset</a>
        </div>
    </form>
  </div>
    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Number</th>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Warehouse</th>
                            <th>Truck No</th>
                            <th>Supplier</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($receipts as $receipt)
                        <tr>
                            <td>{{ $loop->iteration + ($receipts->currentPage()-1)*$receipts->perPage() }}</td>
                            <td>{{ $receipt->number }}</td>
                            <td>{{ \Carbon\Carbon::parse($receipt->document_date)->format('d M, Y') }}</td>
                            <td>{{ $receipt->employee->first_name ?? '-' }}</td>
                            <td>{{ $receipt->warehouse->name ?? '-' }}</td>
                            <td>{{ $receipt->truck_no }}</td>
                            <td>{{ $receipt->supply_point_name ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('goods_receipts.edit', $receipt) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('goods_receipts.destroy', $receipt) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this receipt?')">
                                        <i class="bi bi-trash3"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No receipts found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end mt-3">
        {{ $receipts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

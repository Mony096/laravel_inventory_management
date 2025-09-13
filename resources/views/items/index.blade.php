@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="border p-3 rounded mb-5 bg-white">
 <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-box-seam"></i> Items List
        </h2>
        <a href="{{ route('items.create') }}" class="btn btn-primary">
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

    {{-- ✅ Filter/Search --}}
    <form method="GET" action="{{ route('items.index') }}" class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search by code or name" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="warehouse" class="form-select">
                <option value="Battambang" selected>Battambang</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                <i class="bi bi-search"></i> Filter
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary w-100">
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
                        <th>#</th> {{-- ✅ Index column --}}
                        <th>Code</th>
                        <th>Description</th>
                        <th>Warehouse</th>
                        <th>UoM</th>
                        <th>Unit Price</th>
                        <th>Stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td> {{-- ✅ Index --}}
                            <td><span class="fw-semibold">{{ $item->item_code }}</span></td>
                            <td>{{ $item->item_desc }}</td>
                            <td>Warehouse Battambang</td>
                            <td>{{ $item->uom_code }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>
                                @if($item->quantity_on_stock > 0)
                                    <span class="badge bg-success">{{ $item->quantity_on_stock }}</span>
                                @else
                                    <span class="badge bg-danger">Out of stock</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-primary mr-3">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this item?')">
                                        <i class="bi bi-trash3"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

     {{-- ✅ Pagination --}}
    <div class="d-flex justify-content-end mt-4">
        {{ $items->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

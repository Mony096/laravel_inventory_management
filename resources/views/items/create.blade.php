@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-plus-circle"></i> Create Item
        </h2>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    {{-- Form Card --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('items.store') }}" method="POST">
                @csrf

                {{-- Item Code --}}
                <div class="mb-3">
                    <label for="itemCode" class="form-label fw-semibold">Item Code</label>
                    <input type="text" name="item_code" class="form-control" id="itemCode" placeholder="Enter item code" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="itemDesc" class="form-label fw-semibold">Description</label>
                    <input type="text" name="item_desc" class="form-control" id="itemDesc" placeholder="Enter description" required>
                </div>

                {{-- UoM --}}
                <div class="mb-3">
                    <label for="uomCode" class="form-label fw-semibold">UoM</label>
                    <input type="text" name="uom_code" class="form-control" id="uomCode" placeholder="Enter UoM" required>
                </div>

                {{-- Unit Price --}}
                <div class="mb-3">
                    <label for="unitPrice" class="form-label fw-semibold">Unit Price</label>
                    <input type="number" step="0.01" name="unit_price" class="form-control" id="unitPrice" placeholder="Enter unit price" required>
                </div>

                {{-- Quantity on Stock --}}
                <div class="mb-4">
                    <label for="quantityStock" class="form-label fw-semibold">Quantity on Stock</label>
                    <input type="number" name="quantity_on_stock" class="form-control" id="quantityStock" placeholder="Enter quantity on stock" required>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Save
                    </button>
                    <a href="{{ route('items.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

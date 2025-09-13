@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-pencil-square"></i> Edit Item
        </h2>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    {{-- Form Card --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('items.update', $item) }}" method="POST">
                @csrf @method('PUT')

                <div class="row g-3">
                    {{-- Description --}}
                    <div class="col-md-12">
                        <label for="itemDesc" class="form-label fw-semibold">Description</label>
                        <input type="text" name="item_desc" class="form-control" id="itemDesc" value="{{ $item->item_desc }}" placeholder="Enter description" required>
                    </div>

                    {{-- UoM --}}
                    <div class="col-md-12">
                        <label for="uomCode" class="form-label fw-semibold">UoM</label>
                        <input type="text" name="uom_code" class="form-control" id="uomCode" value="{{ $item->uom_code }}" placeholder="Enter UoM" required>
                    </div>

                    {{-- Unit Price --}}
                    <div class="col-md-12">
                        <label for="unitPrice" class="form-label fw-semibold">Unit Price</label>
                        <input type="number" step="0.01" name="unit_price" class="form-control" id="unitPrice" value="{{ $item->unit_price }}" placeholder="Enter unit price" required>
                    </div>

                    {{-- Quantity on Stock --}}
                    <div class="col-md-12">
                        <label for="quantityStock" class="form-label fw-semibold">Quantity on Stock</label>
                        <input type="number" name="quantity_on_stock" class="form-control" id="quantityStock" value="{{ $item->quantity_on_stock }}" placeholder="Enter quantity on stock" required>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Update
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

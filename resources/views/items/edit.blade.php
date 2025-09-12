@extends('layouts.app')

@section('content')
    <h2>Edit Item</h2>
    <form action="{{ route('items.update', $item) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="item_desc" class="form-control" value="{{ $item->item_desc }}" required>
        </div>
        <div class="mb-3">
            <label>UoM</label>
            <input type="text" name="uom_code" class="form-control" value="{{ $item->uom_code }}" required>
        </div>
        <div class="mb-3">
            <label>Unit Price</label>
            <input type="number" step="0.01" name="unit_price" class="form-control" value="{{ $item->unit_price }}" required>
        </div>
        <div class="mb-3">
            <label>Quantity on Stock</label>
            <input type="number" name="quantity_on_stock" class="form-control" value="{{ $item->quantity_on_stock }}" required>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

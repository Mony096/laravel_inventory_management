@extends('layouts.app')

@section('content')
    <h2>Create Item</h2>
    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Item Code</label>
            <input type="text" name="item_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="item_desc" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>UoM</label>
            <input type="text" name="uom_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Unit Price</label>
            <input type="number" step="0.01" name="unit_price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Quantity on Stock</label>
            <input type="number" name="quantity_on_stock" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

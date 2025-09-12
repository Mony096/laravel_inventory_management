@extends('layouts.app')

@section('content')
    <h2>Items List</h2>
    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Add Item</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Description</th>
                 <th>Warehouse</th>
                <th>UoM</th>
                <th>Unit Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->item_code }}</td>
                <td>{{ $item->item_desc }}</td>
                    <td>Warehouse Battambang</td>
                <td>{{ $item->uom_code }}</td>
                <td>{{ $item->unit_price }}</td>
                <td>{{ $item->quantity_on_stock }}</td>
                <td>
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

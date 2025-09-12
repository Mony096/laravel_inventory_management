@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Goods Receipts</h1>

    <a href="{{ route('goods_receipts.create') }}" class="btn btn-primary mb-3">+ New Receipt</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Document Date</th>
                <th>Employee</th>
                <th>Warehouse</th>
                <th>Truck No</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->number }}</td>
                    <td>{{ $receipt->document_date }}</td>
                    <td>{{ $receipt->employee->first_name ?? '-' }}</td>
                    <td>{{ $receipt->warehouse->name ?? '-' }}</td>
                    <td>{{ $receipt->truck_no }}</td>
                    <td>{{ $receipt->supply_point }}</td>
                    <td>
                        <a href="{{ route('goods_receipts.edit', $receipt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('goods_receipts.destroy', $receipt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this receipt?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No receipts found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $receipts->links() }}
</div>
@endsection

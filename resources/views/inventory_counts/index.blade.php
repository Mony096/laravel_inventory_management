@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inventory Count</h1>

    <a href="{{ route('inventory_counts.create') }}" class="btn btn-primary mb-3">+ New Count</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Count date</th>
                <th>Count Time</th>
                <th>Count Type</th>
                <th>Counted By</th>
                <th>Status</th>
                <th>Warehouse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($counts as $count)
                <tr>
                    <td>{{ $count->id }}</td>
                    <td>{{ $count->count_date }}</td>
                    <td>{{ $count->count_time }}</td>
                    <td>{{ $count->count_type ?? '-' }}</td>
                    <td>{{ $count->inventory_counter_user ?? '-' }}</td>
                    <td>{{ $count->status }}</td>
                    <td>{{ $count->warehouse_id }}</td>
                    <td>
                        <a href="{{ route('inventory_counts.edit', $count->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('inventory_counts.destroy', $count->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this receipt?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No Inventory Count found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $counts->links() }}
</div>
@endsection

@extends('layouts.app')

@section('content')
    <h2>warehouses List</h2>
    <a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-3">Add warehouse</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr class="bg-warning">
                <th>Warehouse Code</th>
                <th>Warehouse Name</th>
                <th>Location</th>
                
            </tr>
        </thead>
        <tbody>
       @foreach($warehouses as $warehouse)
       <tr>
        <td>{{ $warehouse->code }}</td>
        <td>{{ $warehouse->name }}</td>
        <td>{{ $warehouse->location }}</td>
       
        <td>
            <a href="{{ route('warehouses.edit', $warehouse) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this warehouse?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
@endsection

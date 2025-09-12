@extends('layouts.app')

@section('content')
    <h2>Business Place List</h2>
    <a href="{{ route('business_places.create') }}" class="btn btn-primary mb-3">Add Place</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>AliasName</th>
            <th>Contact</th>
            <th>Administrator</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($places as $place)
            <tr>
                 <td>{{ $place->id }}</td>

                <td>{{ $place->Name }}</td>
                <td>{{ $place->Adress }}</td>
                <td>{{ ucfirst($place->AliasName) }}</td>
                <td>{{ $place->Contact }}</td>
                <td>{{ $place->Administrator }}</td>
                
                <td>
                    <a href="{{ route('business_places.edit', $place) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('business_places.destroy', $place) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this Business place ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

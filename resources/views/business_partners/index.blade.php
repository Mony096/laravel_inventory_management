@extends('layouts.app')

@section('content')
    <h2>Business Partner List</h2>
    <a href="{{ route('business_partners.create') }}" class="btn btn-primary mb-3">Add Partner</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
            <th>CardCode</th>
            <th>CardName</th>
            <th>CardType</th>
            <th>Address</th>
            <th>PhoneNumber</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($partners as $partner)
            <tr>
                                <td>{{ $partner->id }}</td>

                <td>{{ $partner->CardCode }}</td>
                <td>{{ $partner->CardName }}</td>
                <td>{{ ucfirst($partner->CardType) }}</td>
                <td>{{ $partner->Address }}</td>
                <td>{{ $partner->PhoneNumber }}</td>
                
                <td>
                    <a href="{{ route('business_partners.edit', $partner) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('business_partners.destroy', $partner) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this Business Partner ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

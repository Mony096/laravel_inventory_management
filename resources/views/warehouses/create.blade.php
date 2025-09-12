@extends('layouts.app')

@section('content')
    <h2>Create Warehouse</h2>
    <form action="{{ route('warehouses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Warehouse Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Warehouse Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>
       
        <button class="btn btn-success">Save</button>
        <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

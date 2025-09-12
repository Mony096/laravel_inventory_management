@extends('layouts.app')
@section('content')
    <h2>Edit warehouse</h2>
    <form action="{{ route('warehouses.update', $warehouse) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="name" class="form-control" value="{{ $warehouse->name }}" required>
        </div>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ $warehouse->location }}" required>
        </div>
        <div class="mb-3">
      
        <button class="btn btn-success">Update</button>
        <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

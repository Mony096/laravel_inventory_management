@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bi bi-house-fill"></i> Edit Warehouse</h2>
            <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ route('warehouses.update', $warehouse) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Warehouse Code</label>
                <input type="text" name="code" class="form-control" value="{{ $warehouse->code }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Warehouse Name</label>
                <input type="text" name="name" class="form-control" value="{{ $warehouse->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ $warehouse->location }}" required>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success"><i class="bi bi-pencil-square"></i> Update</button>
                <a href="{{ route('warehouses.index') }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

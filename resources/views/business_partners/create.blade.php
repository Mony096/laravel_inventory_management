@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-plus-circle"></i> Create Business Partner
            </h2>
            <a href="{{ route('business_partners.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>

        <form action="{{ route('business_partners.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Card Code</label>
                    <input type="text" name="CardCode" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Card Name</label>
                    <input type="text" name="CardName" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Card Type</label>
                    <select name="CardType" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Customer">Customer</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="PhoneNumber" class="form-control">
                </div>
                <div class="col-12">
                    <label>Address</label>
                    <textarea name="Address" class="form-control"></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-success"><i class="bi bi-check-circle"></i> Save</button>
                <a href="{{ route('business_partners.index') }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

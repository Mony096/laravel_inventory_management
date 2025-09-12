@extends('layouts.app')

@section('content')
    <h2>Create Business Partner</h2>
    <form action="{{ route('business_partners.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Card Code</label>
            <input type="text" name="CardCode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Card Name</label>
            <input type="text" name="CardName" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Card Type</label>
            <select name="CardType" class="form-control" required>
                <option value="">-- Select --</option>
                <option value="Supplier">Supplier</option>
                <option value="Customer">Customer</option>
            </select>
        </div>
      
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="PhoneNumber" class="form-control">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="Address" class="form-control"></textarea>
        </div>
      

        <button class="btn btn-success">Save</button>
        <a href="{{ route('business_partners.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

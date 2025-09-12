@extends('layouts.app')

@section('content')
    <h2>Edit Business Partner</h2>
    <form action="{{ route('business_partners.update', $businessPartner) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>card Code</label>
            <input type="text" name="CardCode" class="form-control" value="{{ $businessPartner->CardCode }}" required>
        </div>
        <div class="mb-3">
            <label>Card Name</label>
            <input type="text" name="CardName" class="form-control" value="{{ $businessPartner->CardName }}" required>
        </div>
        <div class="mb-3">
           <label>Card Type</label>
            <select name="CardType" class="form-control" required>
                <option value="Supplier" {{ $businessPartner->CardType == 'Supplier' ? 'selected' : '' }}>Supplier</option>
                <option value="Customer" {{ $businessPartner->CardType == 'Customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>
   
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="Phone Number" class="form-control" value="{{ $businessPartner->PhoneNumber }}">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="Address" class="form-control">{{ $businessPartner->Address }}</textarea>
        </div>
     

        <button class="btn btn-success">Update</button>
        <a href="{{ route('business_partners.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

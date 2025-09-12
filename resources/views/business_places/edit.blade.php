@extends('layouts.app')

@section('content')
    <h2>Edit Business Place</h2>
    <form action="{{ route('business_places.update', $businessPlace) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="Name" class="form-control" value="{{ $businessPlace->Name }}" required>
        </div>
        <div class="mb-3">
            <label>AliasName</label>
            <input type="text" name="AliasName" class="form-control" value="{{ $businessPlace->AliasName }}" required>
        </div>
        {{-- <div class="mb-3">
           <label>Administrator</label>
            <select name="CardType" class="form-control" required>
                <option value="Supplier" {{ $businessPlace->CardType == 'Supplier' ? 'selected' : '' }}>Supplier</option>
                <option value="Customer" {{ $businessPlace->CardType == 'Customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div> --}}
        <div class="mb-3">
         <label>Administrator</label>
         <select name="Administrator" class="form-control" required>
        <option value="" disabled selected>-- Select Administrator --</option>
        @foreach($administrators as $ad)
            <option value="{{ $ad->id }}" {{ $ad->id == $businessPlace->Administrator ? 'selected' : '' }}>{{ $ad->first_name }} - {{ $ad->last_name }}</option>
        @endforeach
    </select>
        </div>
        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="Contact" class="form-control" value="{{ $businessPlace->Contact }}">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="Adress" class="form-control">{{ $businessPlace->Adress }}</textarea>
        </div>
     

        <button class="btn btn-success">Update</button>
        <a href="{{ route('business_partners.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

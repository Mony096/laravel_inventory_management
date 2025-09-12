@extends('layouts.app')

@section('content')
    <h2>Create Business Place</h2>
    <form action="{{ route('business_places.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="Name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>AliasName</label>
            <input type="text" name="AliasName" class="form-control" required>
        </div>
        <div class="mb-3">
         <label>Administrator</label>
         <select name="Administrator" class="form-control" required>
        <option value="" disabled selected>-- Select Administrator --</option>
        @foreach($administrators as $ad)
            <option value="{{ $ad->id }}">{{ $ad->first_name }} - {{ $ad->last_name }}</option>
        @endforeach
    </select>
        </div>
        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="Contact" class="form-control">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="Adress" class="form-control"></textarea>
        </div>
      

        <button class="btn btn-success">Save</button>
        <a href="{{ route('business_places.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-plus-square"></i> Create Business Place
        </h2>
        <a href="{{ route('business_places.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    {{-- Form Card --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('business_places.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input type="text" name="Name" class="form-control" id="name" required>
                    </div>

                    {{-- Alias Name --}}
                    <div class="col-md-6">
                        <label for="aliasName" class="form-label fw-semibold">Alias Name</label>
                        <input type="text" name="AliasName" class="form-control" id="aliasName" required>
                    </div>

                    {{-- Administrator --}}
                    <div class="col-md-6">
                        <label for="administrator" class="form-label fw-semibold">Administrator</label>
                        <select name="Administrator" class="form-select" id="administrator" required>
                            <option value="" disabled selected>-- Select Administrator --</option>
                            @foreach($administrators as $ad)
                                <option value="{{ $ad->id }}">{{ $ad->first_name }} - {{ $ad->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Contact --}}
                    <div class="col-md-6">
                        <label for="contact" class="form-label fw-semibold">Contact</label>
                        <input type="text" name="Contact" class="form-control" id="contact">
                    </div>

                    {{-- Address --}}
                    <div class="col-12">
                        <label for="address" class="form-label fw-semibold">Address</label>
                        <textarea name="Adress" class="form-control" id="address"></textarea>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Save
                    </button>
                    <a href="{{ route('business_places.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

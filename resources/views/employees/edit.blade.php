@extends('layouts.app')

@section('content')
    <h2>Edit Employee</h2>
    <form action="{{ route('employees.update', $employee) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
        </div>
        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
        </div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="M" {{ $employee->gender == 'M' ? 'selected' : '' }}>Male</option>
                <option value="F" {{ $employee->gender == 'F' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ $employee->date_of_birth }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $employee->address }}</textarea>
        </div>
       <div class="mb-3">
            <label>Position</label>
            <select name="position" class="form-control" required>
                <option value="TL" {{ $employee->position == 'TL' ? 'selected' : '' }}>Team Lead</option>
                <option value="ST" {{ $employee->position == 'ST' ? 'selected' : '' }}>Staff</option>
                <option value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Salary</label>
            <input type="number" step="0.01" name="salary" class="form-control" value="{{ $employee->salary }}" required>
        </div>
        <div class="mb-3">
            <label>Hire Date</label>
            <input type="date" name="hire_date" class="form-control" value="{{ $employee->hire_date }}" required>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

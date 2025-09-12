@extends('layouts.app')

@section('content')
    <h2>Create Employee</h2>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="">-- Select --</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Position</label>
           <select name="position" class="form-control" required>
                <option value="">-- Select --</option>
                <option value="TL">Team Lead</option>
                <option value="ST">Staff</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Salary</label>
            <input type="number" step="0.01" name="salary" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Hire Date</label>
            <input type="date" name="hire_date" class="form-control" required>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

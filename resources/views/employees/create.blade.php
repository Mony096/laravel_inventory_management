@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-person-plus-fill"></i> Create Employee
        </h2>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    {{-- Form Card --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    {{-- First Name --}}
                    <div class="col-md-6">
                        <label for="firstName" class="form-label fw-semibold">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Enter first name" required>
                    </div>

                    {{-- Last Name --}}
                    <div class="col-md-6">
                        <label for="lastName" class="form-label fw-semibold">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter last name" required>
                    </div>

                    {{-- Gender --}}
                    <div class="col-md-6">
                        <label for="gender" class="form-label fw-semibold">Gender</label>
                        <select name="gender" class="form-select" id="gender" required>
                            <option value="">-- Select --</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    {{-- Date of Birth --}}
                    <div class="col-md-6">
                        <label for="dob" class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" id="dob" required>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone">
                    </div>

                    {{-- Address --}}
                    <div class="col-12">
                        <label for="address" class="form-label fw-semibold">Address</label>
                        <textarea name="address" class="form-control" id="address" placeholder="Enter address"></textarea>
                    </div>

                    {{-- Position --}}
                    <div class="col-md-6">
                        <label for="position" class="form-label fw-semibold">Position</label>
                        <select name="position" class="form-select" id="position" required>
                            <option value="">-- Select --</option>
                            <option value="TL">Team Lead</option>
                            <option value="ST">Staff</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    {{-- Salary --}}
                    <div class="col-md-6">
                        <label for="salary" class="form-label fw-semibold">Salary</label>
                        <input type="number" step="0.01" name="salary" class="form-control" id="salary" placeholder="Enter salary" required>
                    </div>

                    {{-- Hire Date --}}
                    <div class="col-md-6">
                        <label for="hireDate" class="form-label fw-semibold">Hire Date</label>
                        <input type="date" name="hire_date" class="form-control" id="hireDate" required>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Save
                    </button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

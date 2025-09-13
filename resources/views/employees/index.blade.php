@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="border p-3 rounded mb-5 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-people-fill"></i> Employees List
            </h2>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New
            </a>
        </div>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ✅ Filter/Search --}}
        <form method="GET" action="{{ route('employees.index') }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="position" class="form-select">
                    <option value="">All Positions</option>
                    <option value="TL" {{ request('position')=='TL'?'selected':'' }}>Team Lead</option>
                    <option value="ST" {{ request('position')=='ST'?'selected':'' }}>Staff</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            </div>
        </form>
    </div>

    {{-- ✅ Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Hire Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration + ($employees->currentPage()-1)*$employees->perPage() }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>
                                    @if($employee->gender == 'male')
                                        <span class="badge bg-info text-dark">Male</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Female</span>
                                    @endif
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>${{ number_format($employee->salary,2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->hire_date)->format('d M, Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this employee?')">
                                            <i class="bi bi-trash3"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">No employees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ✅ Pagination --}}
    <div class="d-flex justify-content-end mt-4">
        {{ $employees->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

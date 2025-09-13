@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="border p-3 rounded mb-5 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-people"></i> Business Partner List
            </h2>
            <a href="{{ route('business_partners.create') }}" class="btn btn-primary">
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
        <form method="GET" action="{{ route('business_partners.index') }}" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by code or name" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('business_partners.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Card Code</th>
                            <th>Card Name</th>
                            <th>Card Type</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $partner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $partner->CardCode }}</td>
                                <td>{{ $partner->CardName }}</td>
                                <td>{{ ucfirst($partner->CardType) }}</td>
                                <td>{{ $partner->Address }}</td>
                                <td>{{ $partner->PhoneNumber }}</td>
                                <td class="text-center">
                                    <a href="{{ route('business_partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('business_partners.destroy', $partner) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this Business Partner?')">
                                            <i class="bi bi-trash3"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No business partners found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ✅ Pagination --}}
    <div class="d-flex justify-content-end mt-4">
        {{ $partners->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

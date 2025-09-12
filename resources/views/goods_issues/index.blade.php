@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Goods Issues</h1>

    <a href="{{ route('goods_issues.create') }}" class="btn btn-primary mb-3">+ New issue</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Document Date</th>
                <th>Employee</th>
                <th>Warehouse</th>
                <th>Truck No</th>
                <th>Ship To</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($issues as $issue)
                <tr>
                    <td>{{ $issue->id }}</td>
                    <td>{{ $issue->number }}</td>
                    <td>{{ $issue->document_date }}</td>
                    <td>{{ $issue->employee->first_name ?? '-' }}</td>
                    <td>{{ $issue->warehouse->name ?? '-' }}</td>
                    <td>{{ $issue->truck_no }}</td>
                    <td>{{ $issue->ship_to }}</td>
                    <td>
                        <a href="{{ route('goods_issues.edit', $issue->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('goods_issues.destroy', $issue->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this issue?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No issues found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $issues->links() }}
</div>
@endsection

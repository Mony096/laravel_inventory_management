@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-pencil-square"></i> Edit Goods Issue #{{ $goodsIssue->number }}</h2>
                <a href="{{ route('goods_issues.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <form action="{{ route('goods_issues.update', $goodsIssue->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Number</label>
                        <input type="text" class="form-control" value="{{ $goodsIssue->number }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Document Date</label>
                        <input type="date" name="document_date" class="form-control" value="{{ old('document_date', $goodsIssue->document_date) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Employee</label>
                        <select name="employee_id" class="form-select" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $emp->id == $goodsIssue->employee_id ? 'selected' : '' }}>
                                    {{ $emp->first_name }} {{ $emp->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Truck No</label>
                        <input type="text" name="truck_no" class="form-control" value="{{ old('truck_no', $goodsIssue->truck_no) }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Ship To</label>
                        <select name="ship_to" class="form-select" required>
                            @foreach($places as $pl)
                                <option value="{{ $pl->id }}" {{ $pl->id == $goodsIssue->ship_to ? 'selected' : '' }}>
                                    {{ $pl->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Warehouse</label>
                        <select name="warehouse_id" class="form-select" required>
                            @foreach($warehouses as $wh)
                                <option value="{{ $wh->id }}" {{ $wh->id == $goodsIssue->warehouse_id ? 'selected' : '' }}>
                                    {{ $wh->code }} - {{ $wh->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="my-4">
                <h4 class="text-secondary mb-3">Line Items</h4>

                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-striped table-bordered table-hover align-middle" id="lines-table">
                        <thead class=" text-center">
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>UoM</th>
                                <th>Unit Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($goodsIssue->lines as $i => $line)
                                <tr>
                                    <td>
                                        <select class="form-select" disabled>
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $line->item_id ? 'selected' : '' }}>
                                                    {{ $item->item_code }} - {{ $item->item_desc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" value="{{ $line->item_desc }}" disabled></td>
                                    <td><input type="number" class="form-control" value="{{ $line->quantity }}" disabled></td>
                                    <td><input type="text" class="form-control" value="{{ $line->uom_code }}" disabled></td>
                                    <td><input type="number" step="0.01" class="form-control" value="{{ $line->unit_price }}" disabled></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('goods_issues.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>

                <style>
                    #lines-table thead th {
                        vertical-align: middle;
                        text-align: center;
                    }

                    #lines-table tbody td {
                        vertical-align: middle;
                    }

                    #lines-table tbody tr:hover {
                        background-color: #f8f9fa;
                    }

                    #lines-table select.form-select,
                    #lines-table input.form-control {
                        padding: 0.25rem 0.5rem;
                        font-size: 0.9rem;
                    }

                    .table-responsive {
                        max-height: 400px;
                        overflow-y: auto;
                    }
                </style>
            </form>
        </div>
    </div>
</div>
@endsection

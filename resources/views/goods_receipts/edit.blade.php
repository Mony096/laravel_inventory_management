@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-pencil-square"></i> Edit Goods Receipt #{{ $goodsReceipt->number }}</h2>
                <a href="{{ route('goods_receipts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <form action="{{ route('goods_receipts.update', $goodsReceipt->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-md-2">
                        <label class="form-label">Number</label>
                        <input type="text" class="form-control" value="{{ $goodsReceipt->number }}" disabled>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Document Date</label>
                        <input type="date" class="form-control" value="{{ $goodsReceipt->document_date }}" disabled>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Employee</label>
                        <select name="employee_id" class="form-select" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $emp->id == $goodsReceipt->employee_id ? 'selected' : '' }}>
                                    {{ $emp->first_name }} {{ $emp->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Truck No</label>
                        <input type="text" name="truck_no" class="form-control" value="{{ old('truck_no', $goodsReceipt->truck_no) }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Supplier</label>
                        <select name="supply_point" class="form-select" required>
                            @foreach($partners as $pn)
                                <option value="{{ $pn->id }}" {{ $pn->id == $goodsReceipt->supply_point ? 'selected' : '' }}>
                                    {{ $pn->CardName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Warehouse</label>
                        <select name="warehouse_id" class="form-select" required>
                            @foreach($warehouses as $wh)
                                <option value="{{ $wh->id }}" {{ $wh->id == $goodsReceipt->warehouse_id ? 'selected' : '' }}>
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
        <thead class=" text-white">
            <tr class="text-center">
                <th>Item</th>
                <th>Description</th>
                <th>Qty</th>
                <th>UoM</th>
                <th>Unit Price</th>
                {{-- Hide add button for edit --}}
                <th style="width: 50px;"></th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($goodsReceipt->lines as $i => $line)
            <tr>
                <td>
                    <select disabled name="lines[{{ $i }}][item_id]" class="form-control" required>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $line->item_id ? 'selected' : '' }}>
                            {{ $item->item_code }} - {{ $item->item_desc }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td><input disabled type="text" name="lines[{{ $i }}][item_desc]" class="form-control" value="{{ $line->item_desc }}" required></td>
                <td><input disabled type="number" name="lines[{{ $i }}][quantity]" class="form-control" value="{{ $line->quantity }}" required></td>
                <td><input disabled type="text" name="lines[{{ $i }}][uom_code]" class="form-control" value="{{ $line->uom_code }}" required></td>
                <td><input disabled type="number" step="0.01" name="lines[{{ $i }}][unit_price]" class="form-control" value="{{ $line->unit_price }}" required></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary me-2">
        <i class="bi bi-save"></i> Update
    </button>
    <a href="{{ route('goods_receipts.index') }}" class="btn btn-outline-secondary">
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

    #lines-table select.form-control,
    #lines-table input.form-control {
        padding: 0.25rem 0.5rem;
        font-size: 0.9rem;
    }

    .table-responsive {
        max-height: 400px; /* scrollable table */
        overflow-y: auto;
    }
</style>


            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-pencil-square"></i> Edit Inventory Count #{{ $inventoryCount->id }}</h2>
                <a href="{{ route('inventory_counts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <form action="{{ route('inventory_counts.update', $inventoryCount->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Count Date</label>
                        <input type="date" name="count_date" class="form-control" value="{{ $inventoryCount->count_date }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Count Time</label>
                        <input type="time" name="count_time" class="form-control" value="{{ $inventoryCount->count_time }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Count Type</label>
                        <select name="count_type" class="form-select" required>
                            <option value="Single" {{ $inventoryCount->count_type == 'Single' ? 'selected' : '' }}>Single Count</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Counted By</label>
                        <select name="inventory_counter_user" class="form-select" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $inventoryCount->inventory_counter_user == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->first_name }} {{ $emp->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Warehouse</label>
                        <select name="warehouse_id" class="form-select" required>
                            @foreach($warehouses as $wh)
                                <option value="{{ $wh->id }}" {{ $inventoryCount->warehouse_id == $wh->id ? 'selected' : '' }}>
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
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>In-WHS Qty</th>
                                <th>UoM</th>
                                <th>Counted Qty</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($inventoryCount->lines as $index => $line)
                            <tr>
                                <td>
                                    <select disabled name="lines[{{ $index }}][item_id]" class="form-select item-select" required>
                                        <option value="">-- Select Item --</option>
                                        @foreach($items as $item)
                                            <option 
                                                value="{{ $item->id }}" 
                                                data-description="{{ $item->item_desc }}" 
                                                data-uom="{{ $item->uom_code }}"
                                                data-qty="{{ $item->quantity_on_stock }}"
                                                {{ $line->item_id == $item->id ? 'selected' : '' }}
                                            >
                                                {{ $item->item_code }} - {{ $item->item_desc }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input disabled type="text" name="lines[{{ $index }}][item_desc]" class="form-control item-description" 
                                        value="{{ $line->item_desc }}" readonly required>
                                </td>
                                <td>
                                    <input disabled type="number" name="lines[{{ $index }}][in_whs_quantity]" class="form-control in_whs_quantity" 
                                        value="{{ $line->in_whs_quantity }}" min="0" required>
                                </td>
                                <td>
                                    <input disabled type="text" name="lines[{{ $index }}][uom_counted]" class="form-control item-uom" 
                                        value="{{ $line->uom_counted }}" readonly required>
                                </td>
                                <td>
                                    <input disabled type="number" name="lines[{{ $index }}][counted_qty]" class="form-control" 
                                        value="{{ $line->counted_qty }}" min="0" required>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('inventory_counts.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>

                <style>
                    #lines-table thead th { vertical-align: middle; text-align: center; }
                    #lines-table tbody td { vertical-align: middle; }
                    #lines-table tbody tr:hover { background-color: #f8f9fa; }
                    #lines-table select.form-select,
                    #lines-table input.form-control { padding: 0.25rem 0.5rem; font-size: 0.9rem; }
                    .table-responsive { max-height: 400px; overflow-y: auto; }
                </style>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-plus-circle"></i> Create Inventory Count</h2>
                <a href="{{ route('inventory_counts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <form action="{{ route('inventory_counts.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Count Date</label>
                        <input type="date" name="count_date" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Count Time</label>
                        <input type="time" name="count_time" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Count Type</label>
                        <select name="count_type" class="form-select" required>
                            <option value="Single">Single Count</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Counted By</label>
                        <select name="inventory_counter_user" class="form-select" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Warehouse</label>
                        <select name="warehouse_id" class="form-select" required>
                            @foreach($warehouses as $wh)
                                <option value="{{ $wh->id }}">{{ $wh->code }} - {{ $wh->name }}</option>
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
                                <th style="width:50px;">
                                    <button type="button" id="add-line" class="btn btn-sm btn-success" title="Add Line">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white"></tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save"></i> Save
                    </button>
                    <a href="{{ route('inventory_counts.index') }}" class="btn btn-outline-secondary">
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
                    #lines-table button.remove-line {
                        padding: 0.25rem 0.5rem;
                        font-size: 0.85rem;
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

<script>
document.getElementById('add-line').addEventListener('click', function() {
    let tbody = document.querySelector('#lines-table tbody');
    let index = tbody.children.length;

    let row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <select name="lines[${index}][item_id]" class="form-select item-select" required>
                <option value="">-- Select Item --</option>
                @foreach($items as $item)
                    <option 
                        value="{{ $item->id }}" 
                        data-description="{{ $item->item_desc }}" 
                        data-uom="{{ $item->uom_code }}" 
                        data-qty="{{ $item->quantity_on_stock }}">
                        {{ $item->item_code }} - {{ $item->item_desc }}
                    </option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="lines[${index}][item_desc]" class="form-control item-description" readonly required></td>
        <td><input type="number" name="lines[${index}][in_whs_quantity]" class="form-control in_whs_quantity" min="0" required></td>
        <td><input type="text" name="lines[${index}][uom_counted]" class="form-control item-uom" readonly required></td>
        <td><input type="number" name="lines[${index}][counted_qty]" class="form-control" min="0" required></td>
        <td><button type="button" class="btn btn-sm btn-danger remove-line">x</button></td>
    `;

    tbody.appendChild(row);

    // Remove row
    row.querySelector('.remove-line').addEventListener('click', () => row.remove());

    // Auto-fill description, UoM, and in-warehouse qty
    row.querySelector('.item-select').addEventListener('change', function() {
        let option = this.options[this.selectedIndex];
        row.querySelector('.item-description').value = option.dataset.description || '';
        row.querySelector('.item-uom').value = option.dataset.uom || '';
        row.querySelector('.in_whs_quantity').value = option.dataset.qty || '';
    });
});
</script>
@endsection

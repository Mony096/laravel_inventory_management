@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-plus-circle"></i> Create Goods Receipt</h2>
                <a href="{{ route('goods_receipts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <form action="{{ route('goods_receipts.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Number</label>
                        <input type="text" name="number" class="form-control" value="{{ $nextNumber }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Document Date</label>
                        <input type="date" name="document_date" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Employee</label>
                        <select name="employee_id" class="form-select" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Truck No</label>
                        <input type="text" name="truck_no" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Supplier</label>
                        <select name="supply_point" class="form-select" required>
                            <option value="" disabled selected>-- Select Supplier --</option>
                            @foreach($partners as $pn)
                                <option value="{{ $pn->id }}">{{ $pn->CardName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
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
        <thead class=" text-white">
            <tr class="text-center">
                <th>Item</th>
                <th>Description</th>
                <th>Qty</th>
                <th>UoM</th>
                <th>Unit Price</th>
                <th style="width: 50px;">
                    <button type="button" id="add-line" class="btn btn-sm btn-success" title="Add Line">
                        <i class="bi bi-plus"></i>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <!-- Dynamic rows will appear here -->
        </tbody>
    </table>
</div>

<div class="mt-4 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary me-2">
        <i class="bi bi-save"></i> Save
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
        background-color: #f8f9fa; /* light hover effect */
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
        max-height: 400px; /* scrollable table */
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
                    <option value="{{ $item->id }}" 
                            data-description="{{ $item->item_desc }}" 
                            data-uom="{{ $item->uom_code }}" 
                            data-price="{{ $item->unit_price }}">
                        {{ $item->item_code }} - {{ $item->item_desc }}
                    </option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="lines[${index}][item_desc]" class="form-control item-description" readonly required></td>
        <td><input type="number" name="lines[${index}][quantity]" class="form-control" required></td>
        <td><input type="text" name="lines[${index}][uom_code]" class="form-control item-uom" readonly required></td>
        <td><input type="number" step="0.01" name="lines[${index}][unit_price]" class="form-control item-price" readonly required></td>
        <td><button type="button" class="btn btn-sm btn-danger remove-line">x</button></td>
    `;

    tbody.appendChild(row);

    // Remove row
    row.querySelector('.remove-line').addEventListener('click', function() {
        row.remove();
    });

    // Auto-fill fields when item selected
    row.querySelector('.item-select').addEventListener('change', function() {
        let option = this.options[this.selectedIndex];
        row.querySelector('.item-description').value = option.dataset.description || '';
        row.querySelector('.item-uom').value = option.dataset.uom || '';
        row.querySelector('.item-price').value = option.dataset.price || '';
    });
});
</script>
@endsection

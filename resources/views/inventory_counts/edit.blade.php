@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Inventory Count</h1>

    <form action="{{ route('inventory_counts.update', $inventoryCount->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label>Count Date</label>
            <input type="date" name="count_date" class="form-control" value="{{ $inventoryCount->count_date }}" required>
        </div>

        <div class="mb-3">
            <label>Count Time</label>
            <input type="time" name="count_time" class="form-control" value="{{ $inventoryCount->count_time }}" required>
        </div>

        <div class="mb-3">
            <label>Count Type</label>
            <select name="count_type" class="form-control" required>
                <option value="Single" {{ $inventoryCount->count_type == 'Single' ? 'selected' : '' }}>Single Count</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Counted By</label>
            <select name="inventory_counter_user" class="form-control" required>
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}" {{ $inventoryCount->inventory_counter_user == $emp->id ? 'selected' : '' }}>
                        {{ $emp->first_name }} {{ $emp->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Warehouse</label>
            <select name="warehouse_id" class="form-control" required>
                @foreach($warehouses as $wh)
                    <option value="{{ $wh->id }}" {{ $inventoryCount->warehouse_id == $wh->id ? 'selected' : '' }}>
                        {{ $wh->code }} - {{ $wh->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <hr>
        <h3>Line Items</h3>
        <table class="table" id="lines-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>In-WHS Qty (on Count Date)</th>
                    <th>UoM</th>
                    <th>Counted Qty</th>
                 
                </tr>
            </thead>
            <tbody>
                @foreach($inventoryCount->lines as $index => $line)
                    <tr>
                        <td>
                            <select disabled name="lines[{{ $index }}][item_id]" class="form-control item-select" required>
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

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
document.getElementById('add-line').addEventListener('click', function() {
    let tbody = document.querySelector('#lines-table tbody');
    let index = tbody.children.length;

    let row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <select name="lines[${index}][item_id]" class="form-control item-select" required>
                <option value="">-- Select Item --</option>
                @foreach($items as $item)
                    <option 
                        value="{{ $item->id }}" 
                        data-description="{{ $item->item_desc }}" 
                        data-uom="{{ $item->uom_code }}"
                        data-qty="{{ $item->quantity_on_stock }}"
                    >
                        {{ $item->item_code }} - {{ $item->item_desc }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="text" name="lines[${index}][item_desc]" class="form-control item-description" readonly required>
        </td>
        <td>
            <input type="number" name="lines[${index}][in_whs_quantity]" class="form-control in_whs_quantity" min="0" required>
        </td>
        <td>
            <input type="text" name="lines[${index}][uom_counted]" class="form-control item-uom" readonly required>
        </td>
        <td>
            <input type="number" name="lines[${index}][counted_qty]" class="form-control" min="0" required>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-danger remove-line">x</button>
        </td>
    `;

    tbody.appendChild(row);

    // remove row
    row.querySelector('.remove-line').addEventListener('click', function() {
        row.remove();
    });

    // auto-fill description & uom when item selected
    row.querySelector('.item-select').addEventListener('change', function() {
        let option = this.options[this.selectedIndex];
        row.querySelector('.item-description').value = option.dataset.description || '';
        row.querySelector('.item-uom').value = option.dataset.uom || '';
        row.querySelector('.in_whs_quantity').value = option.dataset.qty || '';
    });
});
</script>
@endsection

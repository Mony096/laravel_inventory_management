@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Inventory Count</h1>

    <form action="{{ route('inventory_counts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Count Date</label>
            <input type="date" name="count_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Count Time</label>
            <input type="time" name="count_time" class="form-control" required>
        </div>
          <div class="mb-3">
            <label>Count Type</label>
            <select name="count_type" class="form-control" required>
                <option value="Signle">Single Count</option>
            </select>
        </div>
   <div class="mb-3">
            <label>Counted By</label>
            <select name="inventory_counter_user" class="form-control" required>
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Warehouse</label>
            <select name="warehouse_id" class="form-control" required>
                {{-- <option value="" disabled selected>-- Select Warehouse --</option> --}}
                @foreach($warehouses as $wh)
                    <option value="{{ $wh->id }}">{{ $wh->code }} - {{ $wh->name }}</option>
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
                    <th>
                        <button type="button" id="add-line" class="btn btn-sm btn-success">+</button>
                    </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <button type="submit" class="btn btn-primary">Save</button>
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
        console.log(this.options[this.selectedIndex]);
        
        row.querySelector('.item-description').value = option.dataset.description || '';
        row.querySelector('.item-uom').value = option.dataset.uom || '';
        row.querySelector('.in_whs_quantity').value = option.dataset.qty || '';

    });
});
</script>
@endsection

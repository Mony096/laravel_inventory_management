@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Goods Issue</h1>

    <form action="{{ route('goods_issues.store') }}" method="POST">
        @csrf

     <div class="mb-3">
    <label>Number</label>
    <input type="text" name="number" class="form-control" value="{{ $nextNumber }}" readonly>
</div>


        <div class="mb-3">
            <label>Document Date</label>
            <input type="date" name="document_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Employee</label>
            <select name="employee_id" class="form-control" required>
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Truck No</label>
            <input type="text" name="truck_no" class="form-control">
        </div>

        {{-- <div class="mb-3">
            <label>Supply Point</label>
            <input type="text" name="supply_point" class="form-control">
        </div> --}}
         <div class="mb-3">
      <label>Ship To</label>
        <select name="ship_to" class="form-control" required>
        <option value="" disabled selected>-- Select Ship To --</option>
        @foreach($places as $pl)
            <option value="{{ $pl->id }}">{{ $pl->Name }}</option>
        @endforeach
    </select>
  </div>

        <div class="mb-3">
            <label>Warehouse</label>
            <select name="warehouse_id" class="form-control" required>
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
                    <th>Qty</th>
                    <th>UoM</th>
                    <th>Unit Price</th>
                    <th><button type="button" id="add-line" class="btn btn-sm btn-success">+</button></th>
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
                    data-price="{{ $item->unit_price }}"
                >
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

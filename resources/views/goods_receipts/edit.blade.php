@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Goods Receipt #{{ $goodsReceipt->number }}</h1>

    <form action="{{ route('goods_receipts.update', $goodsReceipt->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Number</label>
            <input type="text" class="form-control" value="{{ $goodsReceipt->number }}" disabled>
        </div>

        <div class="mb-3">
            <label>Document Date</label>
            <input disabled type="date" name="document_date" class="form-control" value="{{ old('document_date', $goodsReceipt->document_date) }}" required>
        </div>

        <div class="mb-3">
            <label>Employee</label>
            <select name="employee_id" class="form-control" required>
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}" {{ $emp->id == $goodsReceipt->employee_id ? 'selected' : '' }}>
                        {{ $emp->first_name }} {{ $emp->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Truck No</label>
            <input type="text" name="truck_no" class="form-control" value="{{ old('truck_no', $goodsReceipt->truck_no) }}">
        </div>

        {{-- <div class="mb-3">
            <label>Supply Point</label>
            <input type="text" name="supply_point" class="form-control" value="{{ old('supply_point', $goodsReceipt->supply_point) }}">
        </div> --}}
        <div class="mb-3">
            <label>Supplier</label>
             <select name="supply_point" class="form-control" required>
                {{-- @foreach($warehouses as $wh)
                    <option value="{{ $wh->id }}" {{ $wh->id == $goodsReceipt->supply_point ? 'selected' : '' }}>
                        {{ $wh->name }}
                    </option>
                @endforeach
             --}}
               @foreach($partners as $pn)
            <option value="{{ $pn->id }}" {{ $pn->id == $goodsReceipt->supply_point ? 'selected' : '' }}>{{ $pn->CardName }}</option>
        @endforeach
         </select>
        </div>

        <div class="mb-3">
            <label>Warehouse</label>
            <select name="warehouse_id" class="form-control" required>
                @foreach($warehouses as $wh)
                    <option value="{{ $wh->id }}" {{ $wh->id == $goodsReceipt->warehouse_id ? 'selected' : '' }}>
                        {{ $wh->name }}
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
                    <th>Qty</th>
                    <th>UoM</th>
                    <th>Unit Price</th>
                    {{-- <th><button type="button" id="add-line" class="btn btn-sm btn-success">+</button></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($goodsReceipt->lines as $i => $line)
                    <tr>
                        <td>
                            <select disabled name="lines[{{ $i }}][item_id]" class="form-control" required>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $line->item_id ? 'selected' : '' }} >
                                        {{ $item->item_code }} - {{ $item->item_desc }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input disabled type="text" name="lines[{{ $i }}][item_desc]" class="form-control" value="{{ $line->item_desc }}" required></td>
                        <td><input disabled type="number" name="lines[{{ $i }}][quantity]" class="form-control" value="{{ $line->quantity }}" required></td>
                        <td><input disabled type="text" name="lines[{{ $i }}][uom_code]" class="form-control" value="{{ $line->uom_code }}" required></td>
                        <td><input disabled type="number" step="0.01" name="lines[{{ $i }}][unit_price]" class="form-control" value="{{ $line->unit_price }}" required></td>
                        {{-- <td><button type="button" class="btn btn-sm btn-danger remove-line">x</button></td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>

</script>
@endsection

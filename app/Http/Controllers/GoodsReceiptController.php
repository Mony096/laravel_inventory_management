<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceipt;
use App\Models\GoodsReceiptLine;
use App\Models\Employee;
use App\Models\Warehouse;
use App\Models\BusinessPartner;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsReceiptController extends Controller
{
public function index(Request $request)
{
    $query = GoodsReceipt::query();

    // Filters
    if ($request->filled('number')) {
        $query->where('number', 'like', '%' . $request->number . '%');
    }
    if ($request->filled('employee_id')) {
        $query->where('employee_id', $request->employee_id);
    }
    if ($request->filled('warehouse_id')) {
        $query->where('warehouse_id', $request->warehouse_id);
    }
    if ($request->filled('supplier')) {
        $query->where('supply_point', $request->supplier);
    }

    $receipts = $query->latest()->paginate(10)->withQueryString();

    $employees = \App\Models\Employee::all();
    $warehouses = \App\Models\Warehouse::all();
    $partners = \App\Models\BusinessPartner::all();

    return view('goods_receipts.index', compact('receipts', 'employees', 'warehouses', 'partners'));
}



    public function create()
    {
         // Get last record
    $lastNumber = \App\Models\GoodsReceipt::max('number'); 

    // If no records yet, start at 1
    $nextNumber = $lastNumber ? $lastNumber + 1 : 1;
        $employees = Employee::all();
        $warehouses = Warehouse::all();
       $partners  = BusinessPartner::where('CardType', 'Supplier')->get(); 
        $items = Item::all();

        return view('goods_receipts.create', compact('employees', 'warehouses', 'items','nextNumber','partners'));
    }

public function store(Request $request)
{
    $request->validate([
        'number' => 'required|unique:goods_receipts,number',
        'document_date' => 'required|date',
        'employee_id' => 'required|exists:employees,id',
        'supply_point'=>'required|exists:partner,id',
        'warehouse_id' => 'required|exists:warehouses,id',
        'lines.*.item_id' => 'required|exists:items,id',
        'lines.*.item_desc' => 'required|string',
        'lines.*.quantity' => 'required|numeric|min:1',
        'lines.*.uom_code' => 'required|string',
        'lines.*.unit_price' => 'required|numeric|min:0',
    ]);

    DB::transaction(function () use ($request) {
        // 🔹 Generate next number automatically
        $lastNumber = GoodsReceipt::max('number');
        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

        $receipt = GoodsReceipt::create([
            'number'        => $nextNumber,
            'document_date' => $request->document_date,
            'employee_id'   => $request->employee_id,
            'truck_no'      => $request->truck_no,
            'supply_point'  => $request->supply_point,
            'warehouse_id'  => $request->warehouse_id,
        ]);

        foreach ($request->lines as $line) {
            // Create the line
            $receipt->lines()->create($line);

            // Increase stock of the item
            \App\Models\Item::where('id', $line['item_id'])->increment('quantity_on_stock', $line['quantity']);
        }
    });

    return redirect()->route('goods_receipts.index')->with('success', 'Goods Receipt created and stock updated.');
}


    public function edit(GoodsReceipt $goodsReceipt)
    {
        $goodsReceipt->load('lines');
        $employees = Employee::all();
        $warehouses = Warehouse::all();
        $items = Item::all();
        $partners  = BusinessPartner::where('CardType', 'Supplier')->get(); 

        return view('goods_receipts.edit', compact('goodsReceipt','employees','warehouses','items','partners'));
    }

   public function update(Request $request, GoodsReceipt $goodsReceipt)
{
    
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'warehouse_id' => 'required|exists:warehouses,id',
        'truck_no' => 'nullable|string',
        'supply_point' => 'nullable|string',
    ]);

    // Only update header fields
    $goodsReceipt->update($request->only([
        'document_date','employee_id','truck_no','supply_point','warehouse_id'
    ]));

    return redirect()->route('goods_receipts.index')
        ->with('success', 'Goods Receipt header updated successfully.');
}


    public function destroy(GoodsReceipt $goodsReceipt)
    {
        $goodsReceipt->delete(); // lines will be deleted if you set cascade in migration
        return redirect()->route('goods_receipts.index')->with('success', 'Goods Receipt deleted.');
    }
}
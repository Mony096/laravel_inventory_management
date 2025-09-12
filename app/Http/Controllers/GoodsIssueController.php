<?php

namespace App\Http\Controllers;

use App\Models\GoodsIssue;
use Illuminate\Http\Request;
use App\Models\GoodsIssueLine;
use App\Models\Employee;
use App\Models\Warehouse;
use App\Models\Item;
use App\Models\BusinessPlace;

use Illuminate\Support\Facades\DB;

class GoodsIssueController extends Controller
{
     public function index()
    {
        $issues = GoodsIssue::with('employee', 'warehouse')->latest()->paginate(10);
        return view('goods_issues.index', compact('issues'));
    }

    public function create()
    {
            $lastNumber = \App\Models\GoodsIssue::max('number'); 

    // If no records yet, start at 1
    $nextNumber = $lastNumber ? $lastNumber + 1 : 1;
        $employees = Employee::all();
        $warehouses = Warehouse::all();
        $items = Item::all();
        $places = BusinessPlace::all();

        return view('goods_issues.create', compact('employees', 'warehouses', 'items','nextNumber','places'));
    }

// public function store(Request $request)
// {
//     $request->validate([
//         'number' => 'required|unique:goods_issues,number',
//         'document_date' => 'required|date',
//         'employee_id' => 'required|exists:employees,id',
//         'warehouse_id' => 'required|exists:warehouses,id',
//         'lines.*.item_id' => 'required|exists:items,id',
//         'lines.*.item_desc' => 'required|string',
//         'lines.*.quantity' => 'required|numeric|min:1',
//         'lines.*.uom_code' => 'required|string',
//         'lines.*.unit_price' => 'required|numeric|min:0',
//     ]);

//     DB::transaction(function () use ($request) {
//        // 🔹 Generate next number automatically
//         $lastNumber = GoodsIssue::max('number');
//         $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

//         $receipt = GoodsIssue::create([
//             'number'        => $nextNumber,
//             'document_date' => $request->document_date,
//             'employee_id'   => $request->employee_id,
//             'truck_no'      => $request->truck_no,
//             'ship_to'  => $request->ship_to,
//             'warehouse_id'  => $request->warehouse_id,
//         ]);

//         foreach ($request->lines as $line) {
//             // Create the line
//             $receipt->lines()->create($line);

//             // Increase stock of the item
//             \App\Models\Item::where('id', $line['item_id'])->decrement('quantity_on_stock', $line['quantity']);
//         }
//     });

//     return redirect()->route('goods_issues.index')->with('success', 'Goods Issue created and stock updated.');
// }
public function store(Request $request)
{
    $request->validate([
        'document_date' => 'required|date',
        'employee_id' => 'required|exists:employees,id',
        'warehouse_id' => 'required|exists:warehouses,id',
        'lines.*.item_id' => 'required|exists:items,id',
        'lines.*.item_desc' => 'required|string',
        'lines.*.quantity' => 'required|numeric|min:1',
        'lines.*.uom_code' => 'required|string',
        'lines.*.unit_price' => 'required|numeric|min:0',
    ]);

    DB::transaction(function () use ($request) {
        // 🔹 Generate next number automatically
        $lastNumber = GoodsIssue::max('number');
        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

        // 🔹 Check stock before creating receipt
        foreach ($request->lines as $line) {
            $item = \App\Models\Item::find($line['item_id']);

            if (!$item || $item->quantity_on_stock < $line['quantity']) {
                // Throw exception to stop transaction
                
                throw new \Exception("Insufficient stock for item: {$item->item_desc}");
            }
        }

        // 🔹 Create Goods Issue
        $receipt = GoodsIssue::create([
            'number'        => $nextNumber,
            'document_date' => $request->document_date,
            'employee_id'   => $request->employee_id,
            'truck_no'      => $request->truck_no,
            'ship_to'       => $request->ship_to,
            'warehouse_id'  => $request->warehouse_id,
        ]);

        foreach ($request->lines as $line) {
            $receipt->lines()->create($line);

            // Decrease stock
            \App\Models\Item::where('id', $line['item_id'])
                ->decrement('quantity_on_stock', $line['quantity']);
        }
    });

    return redirect()->route('goods_issues.index')
        ->with('success', 'Goods Issue created and stock updated.');
}


    public function edit(GoodsIssue $goodsIssue)
    {
        $goodsIssue->load('lines');
        $employees = Employee::all();
        $warehouses = Warehouse::all();
        $items = Item::all();
        $places = BusinessPlace::all();

        return view('goods_issues.edit', compact('goodsIssue','employees','warehouses','items','places'));
    }

   public function update(Request $request, GoodsIssue $goodsIssue)
{
    
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'warehouse_id' => 'required|exists:warehouses,id',
        'truck_no' => 'nullable|string',
        'ship_to' => 'nullable|string',
    ]);

    // Only update header fields
    $goodsIssue->update($request->only([
        'document_date','employee_id','truck_no','ship_to','warehouse_id'
    ]));

    return redirect()->route('goods_issues.index')
        ->with('success', 'Goods Issue header updated successfully.');
}


    public function destroy(GoodsIssue $goodsIssue)
    {
        $goodsIssue->delete(); // lines will be deleted if you set cascade in migration
        return redirect()->route('goods_issues.index')->with('success', 'Goods Issue deleted.');
    }
}
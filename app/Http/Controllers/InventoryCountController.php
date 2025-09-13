<?php

namespace App\Http\Controllers;

use App\Models\InventoryCount;
use App\Models\InventoryCountLine;
use App\Models\Warehouse;
use App\Models\Item;
use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryCountController extends Controller
{
    /**
     * Show all inventory counts.
     */
  public function index(Request $request)
{
    // Base query with warehouse relationship
    $query = InventoryCount::with('warehouse');

    // Optional filters
    if ($request->filled('number')) {
        $query->where('id', $request->number); // or another field if "number" exists
    }

    if ($request->filled('employee_id')) {
        $query->where('inventory_counter_user', $request->employee_id);
    }

    if ($request->filled('warehouse_id')) {
        $query->where('warehouse_id', $request->warehouse_id);
    }

    // Get paginated results
    $counts = $query->latest()->paginate(10)->withQueryString();

    // Get employees and warehouses for filter dropdown
    $employees = \App\Models\Employee::all();
    $warehouses = \App\Models\Warehouse::all();

    return view('inventory_counts.index', compact('counts', 'employees', 'warehouses'));
}

    /**
     * Show form to create a new count.
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        $items = Item::all();
          $employees =  Employee::where('position', 'ST')->get(); 
        return view('inventory_counts.create', compact('warehouses', 'items','employees'));
    }

    /**
     * Store new inventory count.
     */
    public function store(Request $request)
    {
        $request->validate([
            'count_date'   => 'required|date',
            'count_time' => 'required',
            'warehouse_id' => 'required|exists:warehouses,id',
            'inventory_counter_user' => 'required|exists:employees,id',
            'lines.*.item_id'    => 'required|exists:items,id',
            'lines.*.item_desc'  => 'required|string',
            'lines.*.in_whs_quantity' => 'required|numeric|min:0',
            'lines.*.uom_counted' => 'required|string',
            'lines.*.counted_qty' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $posting = InventoryCount::create([
                'count_date' => $request->count_date,
                'count_time'   => $request->count_time,
                'warehouse_id' => $request->warehouse_id,
                'inventory_counter_user' => $request->inventory_counter_user,

            ]);

            foreach ($request->lines as $line) {
                $posting->lines()->create($line);
                //replace Stock
                 \App\Models\Item::where('id', $line['item_id']) ->update(['quantity_on_stock' => $line['counted_qty']]);
            }
        });

        return redirect()->route('inventory_counts.index')
            ->with('success', 'Inventory Count created successfully.');
    }

    /**
     * Edit form.
     */
    public function edit(InventoryCount $inventoryCount)
    {
        $inventoryCount->load('lines');
        $warehouses = Warehouse::all();
        $items = Item::all();
       $employees =  Employee::where('position', 'ST')->get(); 

        return view('inventory_counts.edit', compact('inventoryCount', 'warehouses', 'items','employees'));
    }

    /**
     * Update posting + lines.
     */
    public function update(Request $request, InventoryCount $inventoryCount)
    {
        $request->validate([
            'count_date' => 'required|date',
            'count_time' => 'required',
            'warehouse_id' => 'required|exists:warehouses,id',
            'inventory_counter_user' =>'required|exists:employees,id',
            'lines.*.item_id'    => 'required|exists:items,id',
            'lines.*.item_desc'  => 'required|string',
            'lines.*.in_whs_quantity' => 'required|numeric|min:0',
            'lines.*.uom_counted' => 'required|string',
            'lines.*.counted_qty' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $inventoryCount) {
            // ✅ update header
            $inventoryCount->update([
                'count_date' => $request->count_date,
                'count_time'   => $request->count_time,
                'warehouse_id' => $request->warehouse_id,
                'inventory_counter_user' => $request->inventory_counter_user,
            ]);

        });

        return redirect()->route('inventory_counts.index')
            ->with('success', 'Inventory Count updated successfully.');
    }

    /**
     * Delete a posting.
     */
    public function destroy(InventoryCount $inventoryCount)
    {
        $inventoryCount->delete();

        return redirect()->route('inventory_counts.index')
            ->with('success', 'Inventory Count deleted successfully.');
    }
}
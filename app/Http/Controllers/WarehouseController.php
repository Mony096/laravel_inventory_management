<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
public function index(Request $request)
{
    // Get search/filter parameters
    $search = $request->input('search');

    // Query warehouses with optional search
    $query = Warehouse::query();

    if ($search) {
        $query->where('name', 'like', '%' . $search . '%')
              ->orWhere('code', 'like', '%' . $search . '%');
    }

    // Paginate results, 10 per page, keeping query parameters
    $warehouses = $query->orderBy('id', 'desc')
                        ->paginate(10)
                        ->appends($request->query());

    // Pass to the view
    return view('warehouses.index', compact('warehouses', 'search'));
}


    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:warehouses',
            'name' => 'required',
            'location' => 'required',       
        ]);

        Warehouse::create($request->all());

        return redirect()->route('warehouses.index')->with('success', 'Warehouse created successfully.');
    }

    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        $warehouse->update($request->all());

        return redirect()->route('warehouses.index')->with('success', 'Warehouse updated successfully.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $item->delete();
        return redirect()->route('warehouses.index')->with('success', 'Warehouse deleted successfully.');
    }
}
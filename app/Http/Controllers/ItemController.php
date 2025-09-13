<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;


class ItemController extends Controller
{
public function index(Request $request)
{
    // ✅ Start query
    $query = Item::query();
    // ✅ Apply search filter (by code or description)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('item_code', 'like', "%{$search}%")
              ->orWhere('item_desc', 'like', "%{$search}%");
        });
    }
    // // ✅ Filter by warehouse (example if you have warehouse field)
    // if ($request->filled('warehouse')) {
    //     $query->where('warehouse_id', $request->warehouse);
    //     // 👆 Change `warehouse_name` to your actual column
    // }

    // ✅ Pagination (10 items per page)
    $items = $query->orderBy('item_code')->paginate(10);

    // Keep query string for pagination links
    $items->appends($request->all());

    return view('items.index', compact('items'));
}


    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_code' => 'required|unique:items',
            'item_desc' => 'required',
            'uom_code' => 'required',
            'unit_price' => 'required|numeric',
            'quantity_on_stock' => 'required|numeric',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item_desc' => 'required',
            'uom_code' => 'required',
            'unit_price' => 'required|numeric',
            'quantity_on_stock' => 'required|numeric',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
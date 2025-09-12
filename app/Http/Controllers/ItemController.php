<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
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
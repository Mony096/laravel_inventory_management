<?php

namespace App\Http\Controllers;

use App\Models\BusinessPlace;
use Illuminate\Http\Request;
use App\Models\Employee;

class BusinessPlaceController extends Controller
{
    /**
     * Display a listing of the business partners.
     */
    public function index()
    {
        $places = BusinessPlace::all();
        return view('business_places.index', compact('places'));
    }

    /**
     * Show the form for creating a new business partner.
     */
    public function create()
    {
      $administrators = Employee::where('position', 'TL')->get(); ;
        return view('business_places.create',compact('administrators'));
    }

    /**
     * Store a newly created business partner in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name'     => 'required|unique:business_places',
            'Adress'     => 'required|string|max:255',
            'AliasName'     => 'required|string|max:100',
            'Contact'      => 'nullable|string|max:255',
            'Administrator'  => 'nullable|string|max:20',
        ]);

        BusinessPlace::create($validated);

        return redirect()->route('business_places.index')
                         ->with('success', 'Business Place created successfully.');
    }

    /**
     * Show the form for editing the specified business partner.
     */
    public function edit(BusinessPlace $businessPlace)
    {
        $administrators = Employee::where('position', 'TL')->get(); ;
        return view('business_places.edit', compact('businessPlace','administrators'));
    }

    /**
     * Display the specified business partner (JSON response).
     */
    public function show(BusinessPlace $businessPlace)
    {
        return response()->json($businessPlace);
    }

    /**
     * Update the specified business partner in storage.
     */
    public function update(Request $request, BusinessPlace $businessPlace)
    {
        $validated = $request->validate([
            'Name'     => 'required|string|max:255|unique:business_places,id,' . $businessPlace->id,
            'Adress'     => 'required|string|max:255',
            'AliasName'     => 'required|string|max:100',
            'Contact'      => 'nullable|string|max:255',
            'Administrator'  => 'nullable|string|max:20',
        ]);

        $businessPlace->update($validated);

        return redirect()->route('business_places.index')
                         ->with('success', 'Business Partner updated successfully.');
    }

    /**
     * Remove the specified business partner from storage.
     */
    public function destroy(BusinessPlace $businessPlace)
    {
        $businessPlace->delete();

        return redirect()->route('business_places.index')
                         ->with('success', 'Business Partner deleted successfully.');
    }
}
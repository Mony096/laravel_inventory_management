<?php

namespace App\Http\Controllers;

use App\Models\BusinessPartner;
use Illuminate\Http\Request;

class BusinessPartnerController extends Controller
{
    /**
     * Display a listing of the business partners.
     */
    public function index()
    {
        $partners = BusinessPartner::all();
        return view('business_partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new business partner.
     */
    public function create()
    {
        return view('business_partners.create');
    }

    /**
     * Store a newly created business partner in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CardCode'     => 'required|unique:business_partners,CardCode',
            'CardName'     => 'required|string|max:255',
            'CardType'     => 'required|string|max:100',
            'Address'      => 'nullable|string|max:255',
            'PhoneNumber'  => 'nullable|string|max:20',
        ]);

        BusinessPartner::create($validated);

        return redirect()->route('business_partners.index')
                         ->with('success', 'Business Partner created successfully.');
    }

    /**
     * Show the form for editing the specified business partner.
     */
    public function edit(BusinessPartner $businessPartner)
    {
        return view('business_partners.edit', compact('businessPartner'));
    }

    /**
     * Display the specified business partner (JSON response).
     */
    public function show(BusinessPartner $businessPartner)
    {
        return response()->json($businessPartner);
    }

    /**
     * Update the specified business partner in storage.
     */
    public function update(Request $request, BusinessPartner $businessPartner)
    {
        $validated = $request->validate([
            'CardCode'     => 'required|string|max:255|unique:business_partners,CardCode,' . $businessPartner->id,
            'CardName'     => 'required|string|max:255',
            'CardType'     => 'required|string|max:100',
            'Address'      => 'nullable|string|max:255',
            'PhoneNumber'  => 'nullable|string|max:20',
        ]);

        $businessPartner->update($validated);

        return redirect()->route('business_partners.index')
                         ->with('success', 'Business Partner updated successfully.');
    }

    /**
     * Remove the specified business partner from storage.
     */
    public function destroy(BusinessPartner $businessPartner)
    {
        $businessPartner->delete();

        return redirect()->route('business_partners.index')
                         ->with('success', 'Business Partner deleted successfully.');
    }
}
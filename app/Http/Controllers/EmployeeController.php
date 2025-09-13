<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
public function index(Request $request)
{
    $query = Employee::query();

    // ✅ Search by first name, last name, or email
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    // ✅ Filter by position if provided
    if ($request->filled('position')) {
        $query->where('position', $request->position);
    }

    // ✅ Paginate results
    $employees = $query->orderBy('id', 'desc')->paginate(10);

    return view('employees.index', compact('employees'));
}

    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'gender'       => 'required|in:M,F,other',
            'date_of_birth'=> 'required|date',
            'email'        => 'required|email|unique:employees,email',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:255',
            'position'     => 'required|in:TL,ST,other',
            'salary'       => 'required|numeric|min:0',
            'hire_date'    => 'required|date',
        ]);

        $employee = Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
  public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }
    /**
     * Display the specified employee.
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, Employee $employee)
{
    $validated = $request->validate([
        'first_name'   => 'sometimes|required|string|max:100',
        'last_name'    => 'sometimes|required|string|max:100',
        'gender'       => 'sometimes|required|in:M,F,other',
        'date_of_birth'=> 'sometimes|required|date',
        'email'        => 'sometimes|required|email|unique:employees,email,' . $employee->id,
        'phone'        => 'nullable|string|max:20',
        'address'      => 'nullable|string|max:255',
        'position'     => 'sometimes|required|in:TL,ST,other',
        'salary'       => 'sometimes|required|numeric|min:0',
        'hire_date'    => 'sometimes|required|date',
    ]);

    $employee->update($validated);

    return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
}


    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully',
        ]);
    }
}
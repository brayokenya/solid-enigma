<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompensationController extends Controller
{
    public function index()
    {
        $compensations = Compensation::all();
        return view('compensations.index', compact('compensations'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'casual_employee_id' => 'required|exists:casual_employees,id',
            'amount' => 'required|numeric',
        ]);

        // Create a new compensation record
        Compensation::create([
            'casual_employee_id' => $request->input('casual_employee_id'),
            'amount' => $request->input('amount'),
        ]);

        return redirect()->route('compensations.index')->with('success', 'Compensation created successfully.');
    }
    public function approve(Request $request, Compensation $compensation)
    {
        // Approve the compensation
        $compensation->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Compensation approved successfully.');
    }

    public function generatePaymentSheet()
    {
        // Generate payment sheet logic here
    }
}

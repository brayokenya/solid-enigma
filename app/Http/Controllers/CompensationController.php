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
            'employee_id' => 'required|exists:casual_employees,id',
            'amount' => 'required|numeric',
        ]);
}

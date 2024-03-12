<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CasualEmployee;

class CasualEmployeeController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CasualEmployee  $casualEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(CasualEmployee $casualEmployee)
    {
        // Retrieve the casual employee from the database
        // and pass it to the edit view
        return view('casuals.edit', compact('casualEmployee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CasualEmployee  $casualEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CasualEmployee $casualEmployee)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'id_number' => ['required', 'string'],
            'casual_code' => ['required', 'string'],
            'branch' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'department' => ['required', 'string'],
            'rate_per_day' => ['required', 'numeric'],
            // Add validation rules for other fields here
        ]);

        // Update the casual employee with the validated data
        $casualEmployee->update($validatedData);

        // Redirect back to the dashboard with a success message
        return redirect('/dashboard')->with('success', 'Casual employee updated successfully!');
    }

    /**
     * Onboard a new casual employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function onboard(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'id_number' => ['required', 'string', 'unique:casual_employees'],
            'casual_code' => ['required', 'string', 'unique:casual_employees'],
            'branch' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'department' => ['required', 'string'],
            'rate_per_day' => ['required', 'numeric'],
        ]);

        // Create a new CasualEmployee instance and save it to the database
        CasualEmployee::create($validatedData);

        // Redirect back to the dashboard with a success message
        return redirect('/dashboard')->with('success', 'Casual employee onboarded successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // Retrieve all casual employees from the database
    $casualEmployees = CasualEmployee::all(['id', 'first_name', 'last_name', 'id_number', 'casual_code', 'branch', 'phone_number', 'gender', 'department', 'rate_per_day', 'status']);

    // Pass casual employees data to the dashboard view
    return view('dashboard', ['casualEmployees' => $casualEmployees]);
    }   

}
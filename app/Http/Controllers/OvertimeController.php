<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overtime;
use App\Models\CasualEmployee;

class OvertimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware for authentication
    }

    public function index()
    {
        $overtimes = Overtime::orderByDesc('id')->get();
        return view('backend.overtime.index', ['overtimes' => $overtimes, 'title' => 'Overtimes']);
    }

    public function create()
    {
        $casualEmployees = CasualEmployee::all();

        return view('backend.overtime.create', ['casualEmployees' => $casualEmployees, 'title' => 'Overtime Create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'hours' => 'required',
            'rate' => 'required',
            'overtime_date' => 'required',
        ]);

        Overtime::create($request->all());

        return redirect()->route('overtime.index')->with('success', 'Overtime has been created.');
    }

    public function edit($id)
    {
        $overtime = Overtime::findOrFail($id);
        return view('backend.overtime.edit', ['overtime' => $overtime, 'title' => 'Overtime Edit']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hours' => 'required',
            'rate' => 'required',
            'overtime_date' => 'required',
        ]);

        $overtime = Overtime::findOrFail($id);
        $overtime->update($request->all());

        return redirect()->route('overtime.index')->with('success', 'Overtime has been updated.');
    }

    public function destroy($id)
    {
        $overtime = Overtime::findOrFail($id);
        $overtime->delete();

        return redirect()->route('overtime.index')->with('success', 'Overtime has been removed.');
    }
}

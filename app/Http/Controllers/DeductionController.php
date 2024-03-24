<?php

namespace App\Http\Controllers;

use App\Models\CasualEmployee;
use App\Models\Deduction;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    protected $deductionModel;
    protected $casualemployeeModel;

    public function __construct(Deduction $deductionModel, CasualEmployee $employeeModel)
    {
        $this->middleware('auth');
        $this->deductionModel = $deductionModel;
        $this->casualemployeeModel = $employeeModel;
    }

    public function index()
    {
        $deductions = $this->deductionModel->with('employee')->orderBy('id', 'desc')->get();
        return view('backend.deduction.index', compact('deductions'));
    }

    public function create()
    {
        $employees = $this->casualemployeeModel->all();
        return view('backend.deduction.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
        ]);

        $this->deductionModel->create($validatedData);

        return redirect()->route('deduction.index')->with('success', 'Deduction successfully created.');
    }

    public function edit(Deduction $deduction)
    {
        $employees = $this->casualemployeeModel->all();
        return view('backend.deduction.edit', compact('deduction', 'employees'));
    }

    public function update(Request $request, Deduction $deduction)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
        ]);

        $deduction->update($validatedData);

        return redirect()->route('deduction.index')->with('success', 'Deduction successfully updated.');
    }

    public function destroy(Deduction $deduction)
    {
        $deduction->delete();
        return redirect()->route('deduction.index')->with('success', 'Deduction successfully deleted.');
    }
}

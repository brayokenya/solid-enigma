<?php

namespace App\Http\Controllers;

use App\Models\CashAdvance;
use Illuminate\Http\Request;
use App\Models\CasualEmployee;
use App\Http\Controllers\Controller;

class CashAdvanceController extends Controller
{
    protected $cashAdvanceModel;
    protected $casualEmployeeModel;

    public function __construct(CashAdvance $cashAdvanceModel, CasualEmployee $casualEmployeeModel)
    {
        $this->cashAdvanceModel = $cashAdvanceModel;
        $this->casualEmployeeModel = $casualEmployeeModel;
    }

    public function index()
    {
        $cashAdvances = $this->cashAdvanceModel->all();

        $data = [
            'title' => 'Cash Advances',
            'cashAdvances' => $cashAdvances
        ];

        return view('backend.cashadvance.index', $data);
    }

    public function create()
    {
        $casualEmployees = $this->casualEmployeeModel->all();

        return view('backend.cashadvance.create', ['title' => 'Create Cash Advance', 'casualEmployees' => $casualEmployees]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_advance' => 'required|date',
            'employee_id' => 'required',
            'amount' => 'required|numeric'
        ]);

        $cashAdvanceData = [
            'date_advance' => $request->input('date_advance'),
            'employee_id' => $request->input('employee_id'),
            'amount' => $request->input('amount')
        ];

        if ($this->cashAdvanceModel->create($cashAdvanceData)) {
            return redirect()->route('cashadvance.index')->with('success', 'Cash Advance successfully created.');
        } else {
            return back()->with('error', 'Failed to create Cash Advance.');
        }
    }

    public function edit($id)
    {
        $cashAdvance = $this->cashAdvanceModel->find($id);
        $casualEmployees = $this->casualEmployeeModel->all();

        return view('backend.cashadvance.edit', ['title' => 'Edit Cash Advance', 'cashAdvance' => $cashAdvance, 'casualEmployees' => $casualEmployees]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_advance' => 'required|date',
            'amount' => 'required|numeric'
        ]);

        $cashAdvanceData = [
            'date_advance' => $request->input('date_advance'),
            'amount' => $request->input('amount')
        ];

        if ($this->cashAdvanceModel->where('id', $id)->update($cashAdvanceData)) {
            return redirect()->route('cashadvance.index')->with('success', 'Cash Advance successfully updated.');
        } else {
            return back()->with('error', 'Failed to update Cash Advance.');
        }
    }

    public function destroy($id)
    {
        if ($this->cashAdvanceModel->destroy($id)) {
            return redirect()->route('cashadvance.index')->with('success', 'Cash Advance successfully deleted.');
        } else {
            return back()->with('error', 'Failed to delete Cash Advance.');
        }
    }
}

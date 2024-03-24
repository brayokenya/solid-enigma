<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\CashAdvance;
use App\Models\CasualEmployee;

class PayrollController extends Controller
{
    protected $payroll;

    public function __construct(Payroll $payroll)
    {
        $this->payroll = $payroll;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Set default values for date range
        $to = now()->toDateString();
        $from = now()->subDays(30)->toDateString();

        // If it's a POST request, process the form data
        if ($request->isMethod('post')) {
            // Validate and sanitize input data
            $validatedData = $request->validate([
                'from' => 'required|date',
                'to' => 'required|date'
            ]);

            // Get the validated input data
            $from = $validatedData['from'];
            $to = $validatedData['to'];
        }

        // Process payroll data
        $payrollData = $this->processPayroll($from, $to);

        // Return the view with payroll data
        return view('backend.payroll.index', $payrollData);
    }

    // Method to process payroll data
    private function processPayroll($from, $to)
    {
        // Retrieve payroll data based on the date range
        $employeeTotalAttendances = $this->payroll->employeeTotalAttendances($from, $to);
        $overtimes = $this->payroll->overtimes($from, $to);
        $cashes = $this->payroll->cash($from, $to);
        $deductions = $this->payroll->advanceDeductions($from, $to);
        $empDeduction = $this->payroll->employeeDeduction($from, $to);
        $empCashes = $this->payroll->employeeCashAdvance($from, $to);

        // Prepare payroll data
        $payrollData = [
            'title' => 'Payroll',
            'payroll' => $employeeTotalAttendances,
            'overtimes' => $overtimes,
            'cashes' => $cashes,
            'deductions' => $deductions,
            'empDeduction' => $empDeduction,
            'empCashes' => $empCashes,
            'from' => $from,
            'to' => $to,
            'from_error' => '',
            'to_error' => ''
        ];

        return $payrollData;
    }
}

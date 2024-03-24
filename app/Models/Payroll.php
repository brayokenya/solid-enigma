<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Deduction;

class Payroll extends Model
{
    protected $table = 'payroll'; // Assuming 'payrolls' is the table name

    // Define the relationships
    // public function deductions()
    // {
    //     return $this->hasMany(Deduction::class);
    // }

    public function casualemployee()
    {
        return $this->belongsTo(casualemployee::class);
    }

    // Method to retrieve employee total attendances
    public function employeeTotalAttendances($from, $to)
    {
        return $this->selectRaw('employee_id, SUM(num_hr) as total_hours')
                    ->whereBetween('created_at', [$from, $to])
                    ->groupBy('employee_id')
                    ->with('employee')
                    ->get();
    }

    // Method to retrieve overtime hours
    public function overtimes($from, $to)
    {
        return $this->selectRaw('employee_id, SUM(hours) as total_overtime')
                    ->whereBetween('overtime_date', [$from, $to])
                    ->groupBy('employee_id')
                    ->with('employee')
                    ->get();
    }

    // Method to retrieve cash advances
    public function cashAdvances($from, $to)
    {
        return $this->selectRaw('employee_id, SUM(amount) as total_advance')
                    ->whereBetween('date_advance', [$from, $to])
                    ->groupBy('employee_id')
                    ->with('employee')
                    ->get();
    }

    // Method to retrieve deductions
    public function deductions($from, $to)
    {
        return $this->selectRaw('employee_id, SUM(amount) as total_deduction')
                    ->whereBetween('created_at', [$from, $to])
                    ->groupBy('employee_id')
                    ->with('employee')
                    ->get();
    }
}

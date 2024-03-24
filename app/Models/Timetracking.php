<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetracking extends Model
{
    use HasFactory;

    protected $table = 'timetracking';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'clock_in',
        'clock_out',
        'date',
    ];

    /**
     * Get the employee that owns the timetracking.
     */

    public function employee()
    {
        return $this->belongsTo(CasualEmployee::class, 'employee_id');

    }
    public function payroll()
    {
        return $this->belongsTo(Payroll::class, 'employee_id', 'id');
    }
}

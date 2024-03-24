<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Deduction extends Model
{
    use HasFactory;

    protected $table = 'deductions';

    protected $primaryKey = 'id';

    protected $fillable = ['employee_id', 'description', 'amount'];

    // Define relationships if any
    public function casualEmployeee()
    {
        return $this->belongsTo(CasualEmployee::class, 'employee_id', 'employee_id');
    }
}

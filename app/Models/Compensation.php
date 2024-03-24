<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Compensation extends Model
{
    use HasFactory;

    protected $fillable = ['casual_employee_id', 'amount'];

    public function casualEmployee()
    {
        return $this->belongsTo(CasualEmployee::class);
    }
   
}

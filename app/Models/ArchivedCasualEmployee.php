<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedCasualEmployee extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'casual_code',
        'branch',
        'phone_number',
        'gender',
        'department',
        'rate_per_day',
        'status',
    ];
}

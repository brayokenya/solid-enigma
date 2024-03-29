<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class CasualEmployee extends Model
{
    protected $table = 'casual_employees'; // Assuming your table name is 'casual_employees'

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

    public static $validationRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'id_number' => 'required|unique:casual_employees',
        'casual_code' => 'required|unique:casual_employees',
        'branch' => 'required',
        'phone_number' => 'required',
        'gender' => 'required',
        'department' => 'required',
        'rate_per_day' => 'required|numeric',
    ];

    public static $validationMessages = [
        'id_number.unique' => 'The ID/Passport Number has already been taken.',
        'casual_code.unique' => 'The Casual Code has already been taken.',
    ];

    public static function validate(array $data)
    {
        return validator($data, self::$validationRules, self::$validationMessages)->validate();
    }

    // Define any relationships or additional methods here
}
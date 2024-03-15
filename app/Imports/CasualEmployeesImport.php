<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\CasualEmployee;

class CasualEmployeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CasualEmployee([
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'id_number' => $row['id_number'],
            'casual_code' => $row['casual_code'],
            'branch' => $row['branch'],
            'phone_number' => $row['phone_number'],
            'gender' => $row['gender'],
            'department' => $row['department'],
            'rate_per_day' => $row['rate_per_day'],
        ]);
    }
}



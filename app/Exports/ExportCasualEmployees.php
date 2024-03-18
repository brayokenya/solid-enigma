<?php

namespace App\Exports;

use App\Models\CasualEmployee;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCasualEmployees implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CasualEmployee::all();
    }
}

<?php

namespace App\Exports;

use App\Models\Timetracking;
use Maatwebsite\Excel\Concerns\FromCollection;

class TimetrackingsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Timetracking::all();
    }
}

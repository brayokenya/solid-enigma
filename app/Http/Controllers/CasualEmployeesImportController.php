<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CasualEmployeesImport;
use Maatwebsite\Excel\Facades\Excel;


class CasualEmployeesImportController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file using Laravel Excel
        Excel::import(new CasualEmployeesImport, $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CasualEmployee;
use App\Imports\CasualEmployeesImport;
use Maatwebsite\Excel\Facades\Excel;

class BulkOnboardController extends Controller
{


        public function bulkOnboard(Request $request)
        {
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|mimes:xlsx,xls|max:2048',
            ]);

            // Get the file from the request
            $file = $request->file('file');

            // Validate the file
            $validator = Validator::make(['file' => $file], [
                'file' => 'required|mimes:xlsx,xls|max:2048',
            ]);

            // If the file is not valid, return with error messages
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Process the uploaded file
            $path = $file->getRealPath();
            $data = Excel::toCollection(new CasualEmployeesImport, $path)->first(); // Assuming only one sheet in the Excel file

            // Iterate through each row of data and create casual employee profiles
            foreach ($data as $row) {
                CasualEmployee::create([
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

            // Redirect back to the dashboard with a success message
            return redirect('/dashboard')->with('success', 'Bulk onboarding completed.');
            // return redirect()->route('bulk-onboard', ['bulk.onboard'=>$bulk.onboard]);
            // return redirect()->route('bulk.onboard')->with('success', 'Bulk onboarding completed.');
        }
    }



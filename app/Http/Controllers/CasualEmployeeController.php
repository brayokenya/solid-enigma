<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CasualEmployee;
use Illuminate\Support\Facades\Session;
use TCPDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use App\Models\ArchivedCasualEmployee;
use App\Imports\CasualEmployeesImport;
use App\Http\Controllers\CasualEmployeesExport;
use App\Http\Controllers\CasualEmployeesImportController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Exports\ExportCasualEmployees;
use App\Models\Timetracking;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\CasualInfoController;


class CasualEmployeeController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CasualEmployee  $casualEmployee
     * @return \Illuminate\Http\Response
     */

     public function show(CasualEmployee $casualEmployee)
{
    return view('/dashboard', compact('casualEmployee'));
}

    public function edit(CasualEmployee $casualEmployee)
    {
        // Retrieve the casual employee from the database
        // and pass it to the edit view
        return view('casuals.edit', compact('casualEmployee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CasualEmployee  $casualEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CasualEmployee $casualEmployee)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'id_number' => ['required', 'string'],
            'casual_code' => ['required', 'string'],
            'branch' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'department' => ['required', 'string'],
            'rate_per_day' => ['required', 'numeric'],

        ]);

         $casualEmployee->update($validatedData);

        return redirect('/dashboard')->with('success', 'Casual employee updated successfully!');
    }

    /**
     * Onboard a new casual employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function onboard(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'id_number' => ['required', 'string', 'unique:casual_employees'],
            'casual_code' => ['required', 'string', 'unique:casual_employees'],
            'branch' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'department' => ['required', 'string'],
            'rate_per_day' => ['required', 'numeric'],
        ]);
        CasualEmployee::create($validatedData);

        return redirect('/dashboard')->with('success', 'Casual employee onboarded successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
      */
    public function index()
{
    $casualEmployees = CasualEmployee::all(['id', 'first_name', 'last_name', 'id_number', 'casual_code', 'branch', 'phone_number', 'gender', 'department', 'rate_per_day', 'status']);
    return view('dashboard', ['casualEmployees' => $casualEmployees]);
}
// }
// public function index(Request $request)
//     {
//         $casualEmployees = CasualEmployee::query();

//         if ($request->has('name')) {
//             $casualEmployees->where('name', 'like', '%' . $request->input('name') . '%');
//         }

//         if ($request->has('department')) {
//             $casualEmployees->where('department', $request->input('department'));
//         }

//         if ($request->has('status')) {
//             $casualEmployees->where('status', $request->input('status'));
//         }

//         $sortBy = $request->input('sort_by', 'name');
//         $sortOrder = $request->input('sort_order', 'asc');
//         $casualEmployees->orderBy($sortBy, $sortOrder);

//         $casualEmployees = $casualEmployees->paginate(10);

//         return view('casual-employees.index', compact('casualEmployees'));
//     }

public function downloadForm(CasualEmployee $casualEmployee)
{
    // Create a new TCPDF instance
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Casual Employee Details');
    $pdf->SetSubject('Casual Employee Details');

    $pdf->AddPage();

    $pdf->SetFont('helvetica', '', 12);

    $pdf->writeHTML("First Name: $casualEmployee->first_name <br>");
    $pdf->writeHTML("Last Name: $casualEmployee->last_name <br>");
    // Add more fields as needed...

    $pdf->Output(public_path('pdfs/casual_employee_details.pdf'), 'F');

    Session::flash('download.in.the.next.request', 'casual_employee_details.pdf');

    return redirect('/dashboard')->with('success', 'PDF generated successfully!');
}
public function downloadFile()
{
    $file_name = Session::get('download.in.the.next.request');

    if ($file_name) {

        $file_path = public_path('pdfs/' . $file_name);

        if (file_exists($file_path)) {
            return response()->download($file_path, $file_name);
        } else {
            return redirect()->back()->with('error', 'File not found for download.');
        }
    } else {
        return redirect()->back()->with('error', 'No file to download.');
    }
}

public function downloadPDF()
{

    $file_path = public_path('pdfs/casual_employee_details.pdf');
    if (file_exists($file_path)) {

        return response()->download($file_path, 'casual_employee_details.pdf');
    } else {

        return redirect()->back()->with('error', 'PDF file not found.');
    }
}

public function initiateFileDownload()
{
    Session::flash('download.in.the.next.request', 'casual_employee_details.pdf');

    return Redirect::to('/dashboard');
}

public function handleFileDownload()
{
    $file_name = Session::get('download.in.the.next.request');

    if ($file_name) {
        $file_path = public_path('pdfs/' . $file_name);

        if (file_exists($file_path)) {

            return response()->download($file_path, $file_name);
        } else {

            return redirect()->back()->with('error', 'File not found for download.');
        }
    } else {
        return redirect()->back()->with('error', 'No file to download.');
    }
}
public function offboard(CasualEmployee $casualEmployee)
{
    // Update the status of the casual employee to indicate departure
    $casualEmployee->update([
        'status' => 'Departed',
        'departure_date' => now(), // Assuming 'departure_date' is a column in your database
        // You can add more fields as needed, such as 'reason_for_leaving'
    ]);

    // Archive the employee's profile and associated data
    $archivedEmployeeData = $casualEmployee->toArray();
    unset($archivedEmployeeData['id']); // Remove the original ID
    ArchivedCasualEmployee::create($archivedEmployeeData);

    // Delete the casual employee from the active employees table
    $casualEmployee->delete();

    // Redirect back to the dashboard with a success message
    return redirect('/dashboard')->with('success', 'Casual employee offboarded successfully!');
}
// EXcel sheet functionality
public function showUploadForm()
{
    return view('upload_form');
}

public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls',
    ]);
// Validate the uploaded file
    $request->validate([
        'file' => 'required|mimes:xlsx,xls',
    ]);

    $file = $request->file('file');

    // Parse Excel file and import data
    Excel::import(new CasualEmployeesImport, $file);

    return redirect('/dashboard')->with('success', 'Casual employees onboarded successfully!');
}
public function exportCasualEmployees()
    {
        // Define the file name for the exported Excel file
        $fileName = 'casual_employees.xlsx';

        // Generate and return the Excel export
        return Excel::download(new ExportCasualEmployees, $fileName);
    }
    public function exportToExcel()
    {
        return Excel::download(new ExportCasualEmployees, 'casual_employees.xlsx');
    }
    public function exportToPDF(Request $request)
    {
        // Retrieve data for PDF export (if needed)
        $casualEmployees = CasualEmployee::all();

        // Generate PDF using DomPDF
        $pdf = PDF::loadView('casual_employees.pdf', compact('casualEmployees'));

        // Return PDF as a response
        return $pdf->download('casual_employees.pdf');
    }

    public function showDownloadForm(CasualEmployee $casualEmployee)
    {
        // Pass the casual employee data to the view
        return view('download_form', compact('casualEmployee'));
    }



 }



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CasualEmployee;
use Illuminate\Support\Facades\Session;
use TCPDF;
use Illuminate\Support\Facades\Redirect;

class CasualEmployeeController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CasualEmployee  $casualEmployee
     * @return \Illuminate\Http\Response
     */
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
            // Add validation rules for other fields here
        ]);

        // Update the casual employee with the validated data
        $casualEmployee->update($validatedData);

        // Redirect back to the dashboard with a success message
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

        // Create a new CasualEmployee instance and save it to the database
        CasualEmployee::create($validatedData);

        // Redirect back to the dashboard with a success message
        return redirect('/dashboard')->with('success', 'Casual employee onboarded successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Retrieve all casual employees from the database
    $casualEmployees = CasualEmployee::all(['id', 'first_name', 'last_name', 'id_number', 'casual_code', 'branch', 'phone_number', 'gender', 'department', 'rate_per_day', 'status']);

    // Pass casual employees data to the dashboard view
    return view('dashboard', ['casualEmployees' => $casualEmployees]);
}
// }

// Inside CasualEmployeeController
public function downloadForm(CasualEmployee $casualEmployee)
{
    // Create a new TCPDF instance
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Casual Employee Details');
    $pdf->SetSubject('Casual Employee Details');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add content to the PDF
    $pdf->writeHTML("First Name: $casualEmployee->first_name <br>");
    $pdf->writeHTML("Last Name: $casualEmployee->last_name <br>");
    $pdf->writeHTML("phone_number: $casualEmployee->phone_number <br>");
    $pdf->writeHTML("casual_code: $casualEmployee->casual-code <br>");
    $pdf->writeHTML("gender: $casualEmployee->gender <br>");
    $pdf->writeHTML("banch: $casualEmployee->branch<br>");
    $pdf->writeHTML("department: $casualEmployee->department <br>");
    $pdf->writeHTML("rate_per_day: $casualEmployee->rate_per_day <br>");


    // Output the PDF as a file
    $pdf->Output(public_path('pdfs/casual_employee_details.pdf'), 'F');

    // Redirect back to the dashboard with a success message
    return redirect('/dashboard')->with('success', 'PDF generated successfully!');
}
public function downloadFile()
{
    $file_path = public_path('pdfs/casual_employee_details.pdf');
    $file_name = 'casual_employee_details.pdf';

    return response()->download($file_path, $file_name);
}
public function downloadPDF()
{
    // Path to the PDF file
    $file_path = public_path('pdfs/casual_employee_details.pdf');

    // Check if the file exists
    if (file_exists($file_path)) {
        // Provide the file for download
        return response()->download($file_path, 'casual_employee_details.pdf');
    } else {
        // Redirect back with an error message if the file does not exist
        return redirect()->back()->with('error', 'PDF file not found.');
    }
}

public function initiateFileDownload()
{
    // Set the flash session with the file name
    Session::flash('download.in.the.next.request', 'casual_employee_details.pdf');

    // Redirect to the page where the file download will be handled
    return Redirect::to('/dashboard');
}

public function handleFileDownload()
{
    // Retrieve the file name from the flash session
    $file_name = Session::get('download.in.the.next.request');

    // Check if the file name exists
    if ($file_name) {
        // Path to the file you want to download
        $file_path = public_path('pdfs/' . $file_name);

        // Check if the file exists
        if (file_exists($file_path)) {
            // Provide the file for download
            return response()->download($file_path, $file_name);
        } else {
            // Redirect back with an error message if the file does not exist
            return redirect()->back()->with('error', 'File not found for download.');
        }
    } else {
        // Redirect back with an error message if the flash session is not set
        return redirect()->back()->with('error', 'No file to download.');
    }
}
}

